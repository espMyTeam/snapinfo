package sn.app.snapinfoapp;

import android.Manifest;
import android.app.Service;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.location.LocationProvider;
import android.os.Build;
import android.os.Bundle;
import android.os.IBinder;
import android.support.v4.app.ActivityCompat;
import android.telephony.TelephonyManager;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;

public class TrackerService extends Service implements LocationListener {

    private double latitude = 0;
    private double longitude = 0;
    private double altitude = 0;

    private String telephone = "";
    private String CellID = "";
    private String MNC = "";
    private String MCC = "";
    private String LAC = "";
    private String operateur = "";
    private String IMEI = "";

    private LocationManager locationManager = null;
    private TelephonyManager telephonyManager = null;

    private int duree = 0;

    /*public TrackerService(int duree) {

        this.duree = duree;


    }*/

    @Override
    public void onCreate() {
        locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            return;
        }

        locationManager.requestLocationUpdates(LocationManager.NETWORK_PROVIDER, 10000,
                0, this);
        locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 10000, 0,
                this);

        trackNetwork();

       // Toast.makeText(getBaseContext(), "on create "+this.latitude, Toast.LENGTH_SHORT).show();

       // try {
        Intent intent = new Intent("track");
        //intent.putExtra("location", (Serializable) this.getTrackLocation());
        intent.putExtra("latitude", ""+this.latitude);
        intent.putExtra("longitude", ""+this.longitude);
        intent.putExtra("altitude", ""+this.altitude);

        intent.putExtra("MNC", this.MNC);
        intent.putExtra("LAC", this.LAC);
        intent.putExtra("MCC", this.MCC);
        intent.putExtra("CellID", this.CellID);
        intent.putExtra("telephone", this.telephone);
        intent.putExtra("operateur", this.operateur);

        sendBroadcast(intent);

        this.onDestroy();
        //} catch (JSONException e) {

        //}

    }

    @Override
    public void onDestroy() {
        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            return;
        }

        if(locationManager != null) {
            locationManager.removeUpdates(this);

        }
    }

    @Override
    public IBinder onBind(Intent intent) {
        return null;
    }

    @Override
    public void onLocationChanged(Location location) {
        longitude = location.getLongitude();
        latitude = location.getLatitude();
        altitude = location.getAltitude();

        trackNetwork();


        Intent intent = new Intent("track");
       // try {
           // intent.putExtra("location", this.getTrackLocation().toString());
            intent.putExtra("latitude", this.latitude);
            intent.putExtra("longitude", this.longitude);
            intent.putExtra("altitude", this.altitude);

            intent.putExtra("MNC", this.MNC);
            intent.putExtra("LAC", this.LAC);
            intent.putExtra("MCC", this.MCC);
            intent.putExtra("CellID", this.CellID);
            intent.putExtra("telephone", this.telephone);
            intent.putExtra("operateur", this.operateur);

            sendBroadcast(intent);
       // } catch (JSONException e) {
         //   Toast.makeText(getBaseContext(), "Probleme de reception ", Toast.LENGTH_LONG).show();
        //}


        Toast.makeText(getBaseContext(), "Localisation réussie: ", Toast.LENGTH_LONG).show();
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
        //Toast.makeText(getBaseContext(), "provider "+s, Toast.LENGTH_SHORT).show();
    }

    @Override
    public void onProviderDisabled(String s) {

    }

    /**
     *
     * @return
     * @throws JSONException
     */
    public JSONObject getTrackLocation() throws JSONException {
        JSONObject postDataParams = new JSONObject();
        postDataParams.put("latitude", this.latitude);
        postDataParams.put("longitude", this.longitude);
        postDataParams.put("altitude", this.altitude);

        postDataParams.put("MNC", this.MNC);
        postDataParams.put("LAC", this.LAC);
        postDataParams.put("MCC", this.MCC);
        postDataParams.put("CellID", this.CellID);
        postDataParams.put("telephone", this.telephone);
        postDataParams.put("operateur", this.operateur);

        return postDataParams;
    }

    public void trackNetwork(){
        //met a jour les infos reseau
        telephonyManager = (TelephonyManager) getSystemService(Context.TELEPHONY_SERVICE);
        this.MCC = telephonyManager.getSimCountryIso();
        this.MNC = telephonyManager.getNetworkOperator()+ "--"+telephonyManager.getCellLocation().toString();
        this.operateur = telephonyManager.getNetworkOperatorName()+"-"+telephonyManager.getSimOperator();
        this.IMEI = telephonyManager.getDeviceId();
        this.CellID = telephonyManager.getCellLocation().toString();
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            this.telephone = ".."+telephonyManager.getPhoneCount() ;//.getPhoneCount();
        }else{
            this.telephone = telephonyManager.getSubscriberId();
        }
    }
}
