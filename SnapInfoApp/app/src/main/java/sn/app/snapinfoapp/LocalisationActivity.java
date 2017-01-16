package sn.app.snapinfoapp;

import android.Manifest;
import android.content.Context;
import android.content.Intent;
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
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.net.URLEncoder;
import java.util.Iterator;
import java.util.List;



public class LocalisationActivity extends AppCompatActivity {

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

    private TelephonyManager telephonyManager;

    private Button btnRefresh;

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_localisation);

        telephonyManager = (TelephonyManager) getSystemService(Context.TELEPHONY_SERVICE);

        btnRefresh = (Button) findViewById(R.id.btnRefresh);
        btnRefresh.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startService(new Intent(LocalisationActivity.this, GeolocalisationService.class));
            }
        });

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

}
