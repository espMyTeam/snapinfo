package sn.app.snapinfoapp;

import android.Manifest;
import android.content.Context;
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
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.File;

public class SendingActivity extends AppCompatActivity implements LocationListener {

    //parametres a envoyer
    private double latitude;
    private double longitude;
    private String typeStructure;
    private String telephone = "";
    private String CellID = "";
    private String MNC = "";
    private String MCC = "";
    private String LAC = "";
    private String operateur = "operateur";
    private String IMEI = "";
    private String commentaire = "";


    private LocationManager locationManager;
    private TelephonyManager telephonyManager;

    private Button btnEnvoyer = null;
    private ImageView lastImg;
    private Spinner spinner = null;

    private String imageFile;

    private String serveur = "http://192.168.1.102/android/SimpleHTTPTeste/teste.php";

    private int inc = 0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sending);

        lastImg = (ImageView) findViewById(R.id.lastImg);
        btnEnvoyer = (Button) findViewById(R.id.btnEnvoyer);

        telephonyManager = (TelephonyManager) getSystemService(Context.TELEPHONY_SERVICE);
        this.paramsNetwork();

        spinner = (Spinner) findViewById(R.id.typeStructure);
        String liste [] = {"police", "mairie", "sapeur pompier"};
        ArrayAdapter<String> dataAdapter = new ArrayAdapter<>(this,
                android.R.layout.simple_spinner_item, liste);
        dataAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinner.setAdapter(dataAdapter);

        Bundle recu = getIntent().getExtras();

        //Toast.makeText(this, "recu "+recu.getString("imageFile"), Toast.LENGTH_LONG).show();
        imageFile = recu.getString("imageFile");
        if (imageFile != null) {


            lastImg.setImageURI(Uri.fromFile(new File(imageFile)));

            btnEnvoyer.setOnClickListener(new View.OnClickListener() {
                public void onClick(View viewParam) {
                    locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
                    if (ActivityCompat.checkSelfPermission(SendingActivity.this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(SendingActivity.this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
                        return;
                    }

                    locationManager.requestLocationUpdates(LocationManager.NETWORK_PROVIDER, 10000,
                            0, SendingActivity.this);
                    locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 10000, 0,
                            SendingActivity.this);

                    //new SendRequest().SendFile(CaptureActivity.this, imageFile,null, serveur);

                }
            });
        }


    }

    @Override
    public void onLocationChanged(Location location) {
        longitude = location.getLongitude();
        latitude = location.getLatitude();
        //TextView valLat= (TextView) findViewById(R.id.valLat);
        //valLat.setText(String.valueOf(latitude));

        //TextView valLng= (TextView) findViewById(R.id.valLng);
        //valLng.setText(String.valueOf(longitude));


        try {
            Toast.makeText(this, "Nouvelle localisation: " + operateur, Toast.LENGTH_LONG).show();
            this.commentaire = ((TextView) findViewById(R.id.commentaire)).getText().toString();
            this.typeStructure = spinner.toString();
            new SendRequest().SendFile(SendingActivity.this, imageFile, formuleData(), serveur);
        } catch (JSONException e) {

        }

        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            return;
        }
        locationManager.removeUpdates(this);
    }

    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) {
        String newStatus = "";
        switch (status) {
            case LocationProvider.OUT_OF_SERVICE:
                newStatus = "OUT_OF_SERVICE";
                break;
            case LocationProvider.TEMPORARILY_UNAVAILABLE:
                newStatus = "TEMPORARILY_UNAVAILABLE";
                break;
            case LocationProvider.AVAILABLE:
                newStatus = "AVAILABLE";
                break;
        }

        //Toast.makeText(getBaseContext(), "statut change", Toast.LENGTH_SHORT).show();
    }

    @Override
    public void onProviderEnabled(String s) {

    }

    @Override
    public void onProviderDisabled(String s) {

    }

    public void paramsNetwork(){
        this.MCC = telephonyManager.getSimCountryIso();
        this.MNC = telephonyManager.getNetworkOperator()+ "--"+telephonyManager.getCellLocation().toString();
        this.operateur = telephonyManager.getNetworkOperatorName()+"-"+telephonyManager.getSimOperator();
        this.IMEI = telephonyManager.getDeviceId();

        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            this.telephone = ".."+telephonyManager.getPhoneCount() ;//.getPhoneCount();
        }else{
            this.telephone = telephonyManager.getSubscriberId();
        }



         /*
        TextView valLng= (TextView) findViewById(R.id.valLng);
        valLng.setText(String.valueOf(this.longitude));*/

    }

    public JSONObject formuleData() throws JSONException {
        JSONObject postDataParams = new JSONObject();
        postDataParams.put("latitude", this.latitude);
        postDataParams.put("longitude", this.longitude);
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
}
