package sn.app.snapinfoapp;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.MenuItem;

public class AboutActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_about);
    }

    /**
     * Réagir aux clicks
     * @param item
     * @return
     */
    @Override
    public boolean onOptionsItemSelected (MenuItem item){

        switch (item.getItemId()){
            case R.id.menu_accueil:
                startActivity(new Intent(this, MainActivity.class));
                return true;
            case R.id.menu_setting:
                startActivity(new Intent(this, SettingsActivity.class));
                return true;
            case R.id.menu_about:
                startActivity(new Intent(this, AboutActivity.class));
                return true;
            case R.id.menu_capture:
                startActivity(new Intent(this, CaptureActivity.class));
                return true;
            case R.id.menu_quit:

                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }
}
