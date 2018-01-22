public class MainActivity extends AppCompatActivity {
  EditText e1,e2;
  Button b1;
  TextView t1;
  String bssid = null;
  
  @Override
  protected void onCreate(Bundle savedInstanceState) {
    super.onCreate(savedInstanceState);
    setContentView(R.layout.activity_main);
    e1= (EditText) findViewById(R.id.editText);
    e2= (EditText) findViewById(R.id.editText2);
    b1= (Button) findViewById(R.id.button);
    t1= (TextView) findViewById(R.id.textView);
    b1.setOnClickListener(new View.OnClickListener() { 
    @Override
    public void onClick(View v) {
      new RequestTask().execute("http://192.168.4.1?esp=" + e1.getText().toString()
                              + "_" + e2.getText().toString() + "_" + bssid + "_");
      } });
      
    ConnectivityManager connManager = (ConnectivityManager) this.getSystemService(this.CONNECTIVITY_SERVICE);
    NetworkInfo networkInfo = connManager.getNetworkInfo(ConnectivityManager.TYPE_WIFI);
    if (networkInfo.isConnected()) {
      final WifiManager wifiManager = (WifiManager) this.getSystemService(this.WIFI_SERVICE);
      final WifiInfo connectionInfo = wifiManager.getConnectionInfo();
      if (connectionInfo != null && !TextUtils.isEmpty(connectionInfo.getSSID())) {
        bssid = connectionInfo.getBSSID();
        }
    } t1.setText(bssid);
  }
}

*******************************************************************************************************

class RequestTask extends AsyncTask<String, String, String>{
  @Override
  protected String doInBackground(String... uri) {
  HttpClient httpclient = new DefaultHttpClient();
  HttpResponse response;
  String responseString = null;
  try {
    response = httpclient.execute(new HttpGet(uri[0]));
    StatusLine statusLine = response.getStatusLine(); 
    if(statusLine.getStatusCode() == HttpStatus.SC_OK){
      ByteArrayOutputStream out = new ByteArrayOutputStream();
      response.getEntity().writeTo(out);
      responseString = out.toString();
      out.close();
    } else{
//Closes the connection. 
    response.getEntity().getContent().close();
    throw new IOException(statusLine.getReasonPhrase());
  }
} catch (ClientProtocolException e) {
//TODO Handle problems.. } catch (IOException e) {
//TODO Handle problems.. }
return responseString; }
}
