package sn.app.myphoto3;

import java.io.DataOutputStream;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.Date;
import java.util.List;

import android.app.Activity;
import android.content.ContentValues;
import android.content.Context;
import android.hardware.Camera;
import android.hardware.Camera.PictureCallback;
import android.hardware.Camera.ShutterCallback;
import android.hardware.Sensor;
import android.hardware.SensorEvent;
import android.hardware.SensorEventListener;
import android.hardware.SensorManager;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationManager;
import android.location.LocationProvider;
import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
import android.provider.MediaStore;
import android.provider.MediaStore.Images;
import android.provider.MediaStore.Images.Media;
import android.util.Log;
import android.view.OrientationEventListener;

import android.view.Surface;
import android.view.SurfaceHolder;
import android.view.SurfaceView;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

public class MainActivity extends Activity implements SurfaceHolder.Callback,
        PictureCallback, ShutterCallback {

    private SurfaceView surfaceView;
    private SurfaceHolder surfaceHolder;
    private Camera camera;
    private TextView textAffiche = null;
    ImageView imgAffiche = null;
    Location position = null;

    //OrientationEventListener myOrientationEventListener;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        this.textAffiche = (TextView) findViewById(R.id.textAffiche);

        this.imgAffiche = (ImageView) findViewById(R.id.imgAffiche);

       /* myOrientationEventListener = new OrientationEventListener(this, SensorManager.SENSOR_DELAY_NORMAL){

            @Override
            public void onOrientationChanged(int i) {
                camera.getParameters().setRotation(i);
                textAffiche.setText("orientation"+i);
            }
        };*/

        surfaceView = (SurfaceView)findViewById(R.id.surface_view);
        surfaceHolder = surfaceView.getHolder();
        surfaceHolder.addCallback(this);
        surfaceHolder.setType(SurfaceHolder.SURFACE_TYPE_PUSH_BUFFERS);
        Button prendrePhoto = (Button) findViewById(R.id.btn_prendrePhoto);
        prendrePhoto.setOnClickListener(new View.OnClickListener() {
            public void onClick(View viewParam) {
                camera.takePicture(MainActivity.this, null,MainActivity.this);
            }
        });

        //recuperer les coordonnees gps
        this.position = this.getPositionGPS();
        if(this.position != null){
           // this.textAffiche.setText(this.position.getLatitude()+"--"+this.position.getLongitude());
        }
    }

    public void surfaceChanged(SurfaceHolder holder, int format, int width,
                               int height) {
        if (camera != null) {
            camera.stopPreview();
            Camera.Parameters p = this.camera.getParameters();
            p.setPreviewSize(width, height);
            this.camera.setParameters(p);
            //this.textAffiche.setText(getWindowManager().getDefaultDisplay().getRotation());
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
        ContentValues values = new ContentValues();
        values.put(Media.TITLE, "Mon image");
        values.put(Media.DESCRIPTION, "Image prise par le téléphone");
        values.put(Media.DATE_TAKEN, new Date().getTime());

        Uri uri = getContentResolver().insert(Images.Media.EXTERNAL_CONTENT_URI,
                values);

        OutputStream os;
        try {
            os = getContentResolver().openOutputStream(uri);
            os.write(data);
            os.flush();
            os.close();

            this.imgAffiche.setImageURI(uri);

            //recuperer encore la position si c'est null
            if(this.position == null){
                this.position = this.getPositionGPS();
            }

            if(this.position != null){
                //this.textAffiche.setText("Position:"+this.position.getLatitude()+"--"+this.position.getLongitude());
            }

        } catch (FileNotFoundException e) {
            Log.e(getClass().getSimpleName(), "Fichier non trouvé à l’écriture de l’image", e);
        } catch (IOException e) {
            Log.e(getClass().getSimpleName(), "Erreur E/S à l’enregistrement de  l’image", e);
        }
        camera.startPreview();
    }
    public void onShutter() {
        Log.d(getClass().getSimpleName(), "Clic clac !");
    }

    public Location getPositionGPS(){
        //selectionner tous les fournisseurs
        LocationManager locationManager = (LocationManager)getSystemService(Context.LOCATION_SERVICE);
        List<String> fournisseurs = locationManager.getAllProviders();

        //definir des criteres
        Criteria criteres = new Criteria();
        // Localisation la plus précise possible
        criteres.setAccuracy(Criteria.ACCURACY_FINE);
        // Altitude fournies obligatoirement
        criteres.setAltitudeRequired(true);

        //selectionne le meilleur fournisseur
        String fournisseurSelectionne = locationManager.getBestProvider(criteres, true);

       // LocationProvider gpsProvider = locationManager.getProvider(fournisseurSelectionne);
        Location location = locationManager.getLastKnownLocation(fournisseurSelectionne);
        if(location != null){
            return location;
        }
        else
            return null;

    }


   /* public int getCorrectCameraOrientation(Camera.CameraInfo info, Camera camera) {

        int rotation = getWindowManager().getDefaultDisplay().getRotation();
        int degrees = 0;

        switch(rotation){
            case Surface.ROTATION_0:
                degrees = 0;
                break;

            case Surface.ROTATION_90:
                degrees = 90;
                break;

            case Surface.ROTATION_180:
                degrees = 180;
                break;

            case Surface.ROTATION_270:
                degrees = 270;
                break;

        }

        int result;

        if(info.facing==Camera.CameraInfo.CAMERA_FACING_FRONT){
            result = (int)(info.orientation + degrees) % 360;
            result = (360-result)%360;
        }else{
            result = (info.orientation-degrees+360)%360;
        }
        this.textAffiche.setText(result);
        return result;
    }*/

    public void UploadFile(Uri uri, String serveur){
        try {
            // Set your file path here
            //FileInputStream fstrm = new FileInputStream(Environment.getExternalStorageDirectory().toString()+"/DCIM/file.mp4");
            FileInputStream fstrm = new FileInputStream(uri.toString());
            // Set your server page url (and the file title/description)
            HttpFileUpload hfu = new HttpFileUpload(uri, serveur, "Photo","description");

            hfu.Send_Now(fstrm);

        } catch (FileNotFoundException e) {
            // Error: File not found
        }
    }

}

class HttpFileUpload implements Runnable{
    URL connectURL;
    String responseString;
    String Title;
    String Description;
    byte[ ] dataToServer;
    FileInputStream fileInputStream = null;
    Uri uri;

    HttpFileUpload(Uri uri, String urlString, String vTitle, String vDesc){
        try{
            connectURL = new URL(urlString);
            Title= vTitle;
            Description = vDesc;
            this.uri = uri;
        }catch(Exception ex){
            Log.i("HttpFileUpload","URL Malformatted");
        }
    }

    void Send_Now(FileInputStream fStream){
        fileInputStream = fStream;
        Sending();
    }

    void Sending(){
        String iFileName = this.uri.toString();//"ovicam_temp_vid.mp4";
        String lineEnd = "\r\n";
        String twoHyphens = "--";
        String boundary = "*****";
        String Tag="fSnd";
        try
        {
            Log.e(Tag,"Starting Http File Sending to URL");

            // Open a HTTP connection to the URL
            HttpURLConnection conn = (HttpURLConnection)connectURL.openConnection();

            // Allow Inputs
            conn.setDoInput(true);

            // Allow Outputs
            conn.setDoOutput(true);

            // Don't use a cached copy.
            conn.setUseCaches(false);

            // Use a post method.
            conn.setRequestMethod("POST");

            conn.setRequestProperty("Connection", "Keep-Alive");

            conn.setRequestProperty("Content-Type", "multipart/form-data;boundary="+boundary);

            DataOutputStream dos = new DataOutputStream(conn.getOutputStream());

            dos.writeBytes(twoHyphens + boundary + lineEnd);
            dos.writeBytes("Content-Disposition: form-data; name=\"title\""+ lineEnd);
            dos.writeBytes(lineEnd);
            dos.writeBytes(Title);
            dos.writeBytes(lineEnd);
            dos.writeBytes(twoHyphens + boundary + lineEnd);

            dos.writeBytes("Content-Disposition: form-data; name=\"description\""+ lineEnd);
            dos.writeBytes(lineEnd);
            dos.writeBytes(Description);
            dos.writeBytes(lineEnd);
            dos.writeBytes(twoHyphens + boundary + lineEnd);

            dos.writeBytes("Content-Disposition: form-data; name=\"uploadedfile\";filename=\"" + iFileName +"\"" + lineEnd);
            dos.writeBytes(lineEnd);

            Log.e(Tag,"Headers are written");

            // create a buffer of maximum size
            int bytesAvailable = fileInputStream.available();

            int maxBufferSize = 1024;
            int bufferSize = Math.min(bytesAvailable, maxBufferSize);
            byte[ ] buffer = new byte[bufferSize];

            // read file and write it into form...
            int bytesRead = fileInputStream.read(buffer, 0, bufferSize);

            while (bytesRead > 0)
            {
                dos.write(buffer, 0, bufferSize);
                bytesAvailable = fileInputStream.available();
                bufferSize = Math.min(bytesAvailable,maxBufferSize);
                bytesRead = fileInputStream.read(buffer, 0,bufferSize);
            }
            dos.writeBytes(lineEnd);
            dos.writeBytes(twoHyphens + boundary + twoHyphens + lineEnd);

            // close streams
            fileInputStream.close();

            dos.flush();

            Log.e(Tag,"File Sent, Response: "+String.valueOf(conn.getResponseCode()));

            InputStream is = conn.getInputStream();

            // retrieve the response from server
            int ch;

            StringBuffer b =new StringBuffer();
            while( ( ch = is.read() ) != -1 ){ b.append( (char)ch ); }
            String s=b.toString();
            Log.i("Response",s);
            dos.close();
        }
        catch (MalformedURLException ex)
        {
            Log.e(Tag, "URL error: " + ex.getMessage(), ex);
        }

        catch (IOException ioe)
        {
            Log.e(Tag, "IO error: " + ioe.getMessage(), ioe);
        }
    }

    @Override
    public void run() {
        // TODO Auto-generated method stub
    }
}
