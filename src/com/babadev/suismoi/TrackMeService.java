package com.babadev.suismoi;

import java.io.IOException;

import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;

import android.app.Service;
import android.content.Context;
import android.content.Intent;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.os.IBinder;
import android.widget.Toast;

public class TrackMeService extends Service {

	private final String GPS_OFF_MESSAGE = "GPS OFF, veuillez activer le GPS";
	private final String URL = "http://127.0.0.1/SuisMoiServer/test.php";
	private final DefaultHttpClient httpclient = new DefaultHttpClient();
	private LocationManager locationMgr;
	private LocationListener onLocationChange =

	new LocationListener() {

		@Override
		public void onLocationChanged(Location location) {

			final LocationManager manager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
			final boolean gpsStatus = manager.isProviderEnabled(LocationManager.GPS_PROVIDER);

			if (gpsStatus) {
				final String latitude = String.valueOf(location.getLatitude());
				final String longitude = String.valueOf(location.getLongitude());
				try {
					sendPosition(latitude, longitude);
				} catch (Exception e) {
					Toast.makeText(getBaseContext(), "Server Error: " + e.getMessage(), Toast.LENGTH_LONG).show();
				}
			} else {
				Toast.makeText(getBaseContext(), GPS_OFF_MESSAGE, Toast.LENGTH_LONG).show();
			}
		}

		@Override
		public void onProviderDisabled(String provider) {
			Toast.makeText(getBaseContext(), "GPS OFF", Toast.LENGTH_LONG).show();
		}

		@Override
		public void onProviderEnabled(String provider) {
			Toast.makeText(getBaseContext(), "GPS ON", Toast.LENGTH_LONG).show();
		}

		@Override
		public void onStatusChanged(String provider, int status, Bundle extras) {
			// TODO Auto-generated method stub
		}

		private void sendPosition(String latitude, String longitude) throws ClientProtocolException, IOException {
			final String deviceName = android.os.Build.MODEL;
			final String message = "Position envoyée : " + deviceName + "@" + latitude + "-" + longitude;
			Toast.makeText(getBaseContext(), message, Toast.LENGTH_LONG).show();
            httpclient.execute(new HttpGet(URL));
		}

	};

	@Override
	public IBinder onBind(Intent arg0) {
		return null;
	}

	@Override
	public void onCreate() {
		locationMgr = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
		if (locationMgr.isProviderEnabled(LocationManager.GPS_PROVIDER)) {
			locationMgr.requestLocationUpdates(LocationManager.GPS_PROVIDER, 0, 100, onLocationChange);
			super.onCreate();
			Toast.makeText(getBaseContext(), "Service SuisMoi : Demarré", Toast.LENGTH_LONG).show();
		} else {
			Toast.makeText(getBaseContext(), GPS_OFF_MESSAGE, Toast.LENGTH_LONG).show();
		}
	}

	@Override
	public int onStartCommand(Intent intent, int flags, int startId) {
		return super.onStartCommand(intent, flags, startId);
	}

	@Override
	public void onDestroy() {
		Toast.makeText(getBaseContext(), "Service SuisMoi : Arrêté", Toast.LENGTH_LONG).show();
		locationMgr.removeUpdates(onLocationChange);
		super.onDestroy();
	}

}