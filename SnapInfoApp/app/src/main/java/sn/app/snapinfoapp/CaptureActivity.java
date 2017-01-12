package sn.app.snapinfoapp;

import android.content.ContentValues;
import android.content.Intent;
import android.hardware.Camera;
import android.net.Uri;
import android.os.Environment;
import android.provider.MediaStore;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.SurfaceHolder;
import android.view.SurfaceView;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.OutputStream;
import java.text.SimpleDateFormat;
import java.util.Date;

public class CaptureActivity extends AppCompatActivity implements SurfaceHolder.Callback,
        Camera.PictureCallback, Camera.ShutterCallback {

    private SurfaceView surfaceView;
    private SurfaceHolder surfaceHolder;
    private Camera camera;

    private Button btnCapturer = null;
    private Button btnEnvoyer = null;
    private String imageFile = null;

    private String serveur = "http://192.168.1.103/android/SimpleHTTPTeste/teste.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_capture);


        btnCapturer = (Button) findViewById(R.id.btnCapturer);
        btnEnvoyer = (Button) findViewById(R.id.btnEnvoyer);

        //demarrer ma camera
        surfaceView = (SurfaceView)findViewById(R.id.surface_view);
        surfaceHolder = surfaceView.getHolder();
        surfaceHolder.addCallback(this);
        surfaceHolder.setType(SurfaceHolder.SURFACE_TYPE_PUSH_BUFFERS);

        //capture d'une photo
        btnCapturer.setOnClickListener(new View.OnClickListener() {
            public void onClick(View viewParam) {
                camera.takePicture(CaptureActivity.this, null,CaptureActivity.this);
            }
        });

        btnEnvoyer.setOnClickListener(new View.OnClickListener() {
            public void onClick(View viewParam) {
                if(imageFile != null){
                    new SendRequest().SendFile(CaptureActivity.this, imageFile, serveur);
                }
            }
        });

    }

    public void surfaceChanged(SurfaceHolder holder, int format, int width,
                               int height) {
        if (camera != null) {
            camera.stopPreview();
            Camera.Parameters p = this.camera.getParameters();
            p.setPreviewSize(width, height);
            this.camera.setParameters(p);

            try {
                this.camera.setPreviewDisplay(holder);
                this.camera.startPreview();
            } catch (IOException e) {
                Log.e(getClass().getSimpleName(),
                        "Erreur E/S lors du setPreviewDisplay sur l’objet Camera", e);
            }
        }
    }

    public void surfaceCreated(SurfaceHolder holder) {
        camera = Camera.open();
    }

    public void surfaceDestroyed(SurfaceHolder holder) {
        if (camera != null) {
            camera.stopPreview();
            camera.release();
        }
    }

    public void onPictureTaken(byte[] data, Camera arg1) {
        SimpleDateFormat timeStampFormat = new SimpleDateFormat(
                "yyyy-MM-dd-HH.mm.ss");
        String fileName = "snap_" + timeStampFormat.format(new Date())
                + ".jpg";

        ContentValues values = new ContentValues();
        values.put(MediaStore.MediaColumns.TITLE, "Mon image");
        values.put(MediaStore.Images.ImageColumns.DESCRIPTION, "Image prise par le téléphone");
        values.put(MediaStore.Images.Media.DATE_TAKEN, new Date().getTime());
        values.put(MediaStore.Images.ImageColumns.DISPLAY_NAME, fileName);
        values.put(MediaStore.Images.Media.MIME_TYPE, "image/jpeg");
        values.put(MediaStore.Images.ImageColumns.LATITUDE, "14.89");




        //Uri uri = getContentResolver().insert(MediaStore.Images.Media.EXTERNAL_CONTENT_URI,
          //      values);
        File temp_file = new File(Environment.getExternalStorageDirectory().toString()+"/DCIM/"+fileName);
        Uri uri = Uri.fromFile(temp_file);

        OutputStream os;
        try {
            os = getContentResolver().openOutputStream(uri);
            os.write(data);
            os.flush();
            os.close();

            imageFile = temp_file.getAbsolutePath();
            //imageFile.renameTo();
           // Toast.makeText(getApplicationContext(), "Image "+imageFile.getAbsolutePath(),
             //       Toast.LENGTH_LONG).show();


        } catch (FileNotFoundException e) {
            Log.e(getClass().getSimpleName(), "Fichier non trouvé à l’écriture de l’image", e);
        } catch (IOException e) {
            Log.e(getClass().getSimpleName(), "Erreur E/S à l’enregistrement de  l’image", e);
        }
        camera.startPreview();
    }
    public void onShutter() {
        Log.d(getClass().getSimpleName(), "Nickel");
    }

    /**
     * deserialiser le menu
     */
    @Override
    public boolean onCreateOptionsMenu(Menu menu){
        super.onCreateOptionsMenu(menu);
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.menu, menu);
        //menu.getItem(0).getSubMenu().setHeaderIcon(R.drawable.option_white);
        return true;
    }
    /**
     * Réagir aux clicks
     * @param item
     * @return
     */
    @Override
    public boolean onOptionsItemSelected (MenuItem item){

        switch (item.getItemId()){
            case R.id.menu_accueil:
                startActivity(new Intent(this, MainActivity.class));
                return true;
            case R.id.menu_setting:
                startActivity(new Intent(this, SettingsActivity.class));
                return true;
            case R.id.menu_about:
                startActivity(new Intent(this, AboutActivity.class));
                return true;
            case R.id.menu_capture:
                startActivity(new Intent(this, CaptureActivity.class));
                return true;
            case R.id.menu_quit:
                finish();
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }
}
