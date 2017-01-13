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

public class LocalisationActivity extends AppCompatActivity {

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_localisation);



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


}
