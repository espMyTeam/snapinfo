package sn.app.snapinfoapp;

import android.Manifest;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.location.LocationProvider;
import android.net.Uri;
import android.os.Build;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.telephony.TelephonyManager;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.File;

public class SendingActivity extends AppCompatActivity{

    private String latitude;
    private String longitude;
    private String altitude;
    private String telephone = "";
    private String CellID = "";
    private String MNC = "";
    private String MCC = "";
    private String LAC = "";
    private String operateur = "";
    private String IMEI = "";

    private String typeStructure = "";
    private String commentaire = "";


    private Button btnEnvoyer = null;
    private ImageView lastImg;
    private Spinner spinner = null;

    private String imageFile;

    private String serveur = "http://192.168.1.102/android/SimpleHTTPTeste/teste.php";

    private RecepteurSending recepteur;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sending);

        lastImg = (ImageView) findViewById(R.id.lastImg);
        btnEnvoyer = (Button) findViewById(R.id.btnEnvoyer);


        spinner = (Spinner) findViewById(R.id.typeStructure);
        String liste [] = {"police", "mairie", "sapeur pompier"};
        ArrayAdapter<String> dataAdapter = new ArrayAdapter<>(this,
                android.R.layout.simple_spinner_item, liste);
        dataAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinner.setAdapter(dataAdapter);

        Bundle recu = getIntent().getExtras();
        imageFile = recu.getString("imageFile");

        recepteur = new RecepteurSending();
        IntentFilter filter = new IntentFilter("track");
        registerReceiver(recepteur, filter);

        //Toast.makeText(this, "recu "+recu.getString("imageFile"), Toast.LENGTH_LONG).show();

        if (imageFile != null) {


            lastImg.setImageURI(Uri.fromFile(new File(imageFile)));

            btnEnvoyer.setOnClickListener(new View.OnClickListener() {
                public void onClick(View viewParam) {

                    Toast.makeText(SendingActivity.this, "Envoie en cours ", Toast.LENGTH_SHORT).show();
                    //new SendRequest().SendFile(CaptureActivity.this, imageFile,null, serveur);
                    Intent service = new Intent(SendingActivity.this, TrackerService.class);
                    startService(service);

                }
            });
        }


    }





    public JSONObject formuleData() throws JSONException {
        JSONObject postDataParams = new JSONObject();
        postDataParams.put("latitude", this.latitude);
        postDataParams.put("longitude", this.longitude);
        postDataParams.put("altitude", this.altitude);
        postDataParams.put("typeStructure", this.typeStructure);
        postDataParams.put("MNC", this.MNC);
        postDataParams.put("LAC", this.LAC);
        postDataParams.put("MCC", this.MCC);
        postDataParams.put("CellID", this.CellID);
        postDataParams.put("telephone", this.telephone);
        postDataParams.put("operateur", this.operateur);
        postDataParams.put("commentaire", this.commentaire);
        return postDataParams;
    }

    class RecepteurSending extends BroadcastReceiver {
        @Override
        public void onReceive(Context context, Intent intent) {
            //Toast.makeText(context, "Intent.", Toast.LENGTH_LONG).show();
            if(intent.getExtras() != null) {


                commentaire = ((TextView) findViewById(R.id.commentaire)).getText().toString();


                latitude = intent.getExtras().getString("altitude");
                longitude = intent.getExtras().getString("longitude");
                altitude = intent.getExtras().getString("altitude");

                MCC = intent.getExtras().getString("MCC");
                MNC = intent.getExtras().getString("MNC");
                operateur = intent.getExtras().getString("operateur");
                CellID = intent.getExtras().getString("CellID");
                telephone = intent.getExtras().getString("telephone");
                LAC = intent.getExtras().getString("LAC");

                try {
                    new SendRequest().SendFile(SendingActivity.this, imageFile, formuleData(), serveur);
                } catch (JSONException e) {
                    Toast.makeText(context, "Envoi de fichier impossible...", Toast.LENGTH_LONG).show();
                }


            }

        }
    }
}
