package sn.app.snapinfoapp;

import android.Manifest;
import android.app.Activity;
import android.content.Context;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.location.LocationProvider;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.support.v4.app.ActivityCompat;
import android.telephony.TelephonyManager;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by abdoulaye on 12/01/17.
 */
public class Geolocalise extends AsyncTask<String, Void, String> implements LocationListener {

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

    private Context context;
    private Activity activite = null;

    public Geolocalise(Activity activite) {
        this.activite = activite;
        locationManager = (LocationManager) activite.getSystemService(Context.LOCATION_SERVICE);

        telephonyManager = (TelephonyManager) context.getSystemService(Context.TELEPHONY_SERVICE);

        if (locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER)) {
            if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
                //context.finish();
                //return 0;
            }

            locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 10000, 0,
                    this);
            locationManager.req
        }

        else
            locationManager.requestLocationUpdates(LocationManager.NETWORK_PROVIDER, 10000, 0,
                this);
    }

    public void updateLocalisation(){
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

    protected void onPreExecute(){}

    @Override
    protected String doInBackground(String... strings) {
        return null;
    }

    @Override
    protected void onPostExecute(String result) {
        Toast.makeText(context, result,
                Toast.LENGTH_LONG).show();
    }
}
