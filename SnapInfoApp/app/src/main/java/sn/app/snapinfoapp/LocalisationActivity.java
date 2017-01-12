package sn.app.snapinfoapp;

import android.Manifest;
import android.content.Context;
import android.content.pm.PackageManager;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.location.LocationProvider;
import android.os.Build;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.telephony.TelephonyManager;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.net.URLEncoder;
import java.util.Iterator;
import java.util.List;

public class LocalisationActivity extends AppCompatActivity implements LocationListener {

    private double latitude;
    private double longitude;
    private String typeStructure;
    private String telephone = "";
    private String CellID = "";
    private String MNC = "";
    private String MCC = "";
    private String LAC = "";
    private String operateur = "";
    private String IMEI = "";

    private LocationManager locationManager;
    private TelephonyManager telephonyManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_localisation);
        locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);

        telephonyManager= (TelephonyManager)getSystemService(Context.TELEPHONY_SERVICE);

        if (locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER)) {
            if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
                finish();
            }

            locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 10000, 0,
                    this);
            locationManager.requestLocationUpdates(LocationManager.NETWORK_PROVIDER, 10000, 0,
                    this);
        }


    }

    public void updateLocalisation(){
        this.MCC = telephonyManager.getSimCountryIso();
        this.MNC = telephonyManager.getNetworkOperator()+ "--"+telephonyManager.getCellLocation().toString();
        this.operateur = telephonyManager.getNetworkOperatorName()+"-"+telephonyManager.getSimOperator().;
        this.IMEI = telephonyManager.getDeviceId();
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            this.telephone = ".."+telephonyManager.getPhoneCount() ;//.getPhoneCount();
        }else{
            this.telephone = telephonyManager.getSubscriberId();
        }

        TextView valMCC= (TextView) findViewById(R.id.valMCC);
        valMCC.setText(String.valueOf(this.MCC));

        TextView valMNC= (TextView) findViewById(R.id.valMNC);
        valMNC.setText(String.valueOf(this.MNC));

        TextView valTel= (TextView) findViewById(R.id.valTel);
        valTel.setText(String.valueOf(this.telephone));

        TextView valOperateur= (TextView) findViewById(R.id.valOperateur);
        valOperateur.setText(String.valueOf(this.operateur));

         /*
        TextView valLng= (TextView) findViewById(R.id.valLng);
        valLng.setText(String.valueOf(this.longitude));*/

    }

    public void getPositionGPS() {
        //selectionner tous les fournisseurs

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
        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            // TODO: Consider calling
            //    ActivityCompat#requestPermissions
            // here to request the missing permissions, and then overriding
            //   public void onRequestPermissionsResult(int requestCode, String[] permissions,
            //                                          int[] grantResults)
            // to handle the case where the user grants the permission. See the documentation
            // for ActivityCompat#requestPermissions for more details.
            Location location = locationManager.getLastKnownLocation(fournisseurSelectionne);


        }


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

        return new Routing().RoutingMenu(item, this);
    }


    public JSONObject formule() throws JSONException {
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
        return postDataParams;
    }

    @Override
    public void onLocationChanged(Location location) {
        this.longitude = location.getLongitude();
        this.latitude = location.getLatitude();
        TextView valLat= (TextView) findViewById(R.id.valLat);
        valLat.setText(String.valueOf(this.latitude));

        TextView valLng= (TextView) findViewById(R.id.valLng);
        valLng.setText(String.valueOf(this.longitude));

        Toast.makeText(this, "Nouvelle localisation", Toast.LENGTH_LONG).show();

        updateLocalisation();
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

        //Toast.makeText(this, "statut change", Toast.LENGTH_SHORT).show();

    }

    @Override
    public void onProviderEnabled(String s) {
        Toast.makeText(this, "La localisation est disponible", Toast.LENGTH_SHORT).show();
    }

    @Override
    public void onProviderDisabled(String s) {
        Toast.makeText(this, "La localisation GPS est désactivée", Toast.LENGTH_SHORT).show();
    }
}
