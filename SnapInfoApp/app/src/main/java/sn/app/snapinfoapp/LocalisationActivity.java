package sn.app.snapinfoapp;


import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;


public class LocalisationActivity extends AppCompatActivity {


    private Button btnRefresh;

    private Recepteur recepteur;

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_localisation);



        recepteur = new Recepteur();
        IntentFilter filter = new IntentFilter("track");
        registerReceiver(recepteur, filter);

        btnRefresh = (Button) findViewById(R.id.btnRefresh);
        btnRefresh.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent service = new Intent(LocalisationActivity.this, TrackerService.class);
                //service.putExtra("duree", 1000);
                startService(service);
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


    class Recepteur extends BroadcastReceiver {
        @Override
        public void onReceive(Context context, Intent intent) {
            //Toast.makeText(context, "Intent.", Toast.LENGTH_LONG).show();
            if(intent.getExtras() != null) {

                //try {
                   // JSONObject recu = (JSONObject) intent.getExtras().getSerializable("location");
                    //Toast.makeText(context, "Intent Detected." +intent.getExtras().getString("altitude"), Toast.LENGTH_LONG).show();
               // } catch (JSONException e) {

                //}
                ((TextView) findViewById(R.id.valLat)).setText(intent.getExtras().getString("altitude"));
                ((TextView) findViewById(R.id.valLng)).setText(intent.getExtras().getString("longitude"));

                ((TextView) findViewById(R.id.valMCC)).setText(intent.getExtras().getString("MCC"));
                ((TextView) findViewById(R.id.valMNC)).setText(intent.getExtras().getString("MNC"));
                ((TextView) findViewById(R.id.valOperateur)).setText(intent.getExtras().getString("operateur"));
                ((TextView) findViewById(R.id.valCellID)).setText(intent.getExtras().getString("CellID"));
                ((TextView) findViewById(R.id.valTel)).setText(intent.getExtras().getString("telephone"));
                ((TextView) findViewById(R.id.valLAC)).setText(intent.getExtras().getString("LAC"));

                //JSONObject datas = intent.getExtras().getString("location");
            }

        }
    }

}
