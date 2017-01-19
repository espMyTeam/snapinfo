package sn.app.snapinfoapp;

import android.app.Activity;
import android.content.Intent;
import android.view.MenuItem;

/**
 * Created by abdoulaye on 12/01/17.
 */
public class Routing {

    public Routing(){

    }

    public boolean RoutingMenu(MenuItem item, Activity activite){
        switch (item.getItemId()){
            case R.id.menu_accueil:
                activite.startActivity(new Intent(activite, MainActivity.class));
                activite.finish();
                return true;
            case R.id.menu_setting:
                activite.startActivity(new Intent(activite, SettingsActivity.class));
                //activite.finish();
                return true;
            case R.id.menu_about:
                activite.startActivity(new Intent(activite, AboutActivity.class));
                //activite.finish();
                return true;
            case R.id.menu_capture:
                activite.startActivity(new Intent(activite, CaptureActivity.class));
                //activite.finish();
                return true;
            case R.id.menu_position:
                activite.startActivity(new Intent(activite, LocalisationActivity.class));
                //activite.finish();
                return true;
            case R.id.menu_quit:
                activite.finish();
                return true;
            default:
                return activite.onOptionsItemSelected(item);
        }
    }
}
