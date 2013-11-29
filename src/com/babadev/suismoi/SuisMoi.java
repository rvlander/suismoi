package com.babadev.suismoi;

import android.app.Activity;
import android.app.ActivityManager;
import android.app.ActivityManager.RunningServiceInfo;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ToggleButton;

public class SuisMoi extends Activity {

	private ToggleButton startStopServicetoggleButton;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_suis_moi);

		startStopServicetoggleButton = (ToggleButton) findViewById(R.id.startStopServicetoggleButton);
		startStopServicetoggleButton.setOnClickListener(
		new OnClickListener() {

			@Override
			public void onClick(View v) {
				if (startStopServicetoggleButton.isChecked()) {
					startService(new Intent(SuisMoi.this, TrackMeService.class));
				} else {
					stopService(new Intent(SuisMoi.this, TrackMeService.class));
				}

			}
		});
		this.areServicesRunning();
	}

	@Override
    protected void onResume() {
        super.onResume();
        this.areServicesRunning();
    };
    
    /**
     * 
     */
	private void areServicesRunning() {
		this.startStopServicetoggleButton.setChecked(false);
        ActivityManager manager = (ActivityManager) getSystemService(Context.ACTIVITY_SERVICE);
        for (RunningServiceInfo service : manager.getRunningServices(Integer.MAX_VALUE)) {
            if (TrackMeService.class.getName().equals(service.service.getClassName())) {
                this.startStopServicetoggleButton.setChecked(true);
            }
        }
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.suis_moi, menu);
		return true;
	}

}
