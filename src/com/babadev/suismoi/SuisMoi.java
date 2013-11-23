package com.babadev.suismoi;

import android.os.Bundle;
import android.app.Activity;
import android.view.Menu;

public class SuisMoi extends Activity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_suis_moi);
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.suis_moi, menu);
		return true;
	}

}
