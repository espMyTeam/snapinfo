package sn.app.snapinfoapp;

import android.content.Context;
import android.os.AsyncTask;
import android.widget.Toast;

import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.util.Iterator;

/**
 * Created by abdoulaye on 12/01/17.
 */
public class SendRequest {

    private Context context;
    private String fileAbsolutePath;
    private String destination;

   // public SendRequest(CaptureActivity captureActivity, String imageFile, String serveur) {
    //}

    /**
     *
     * @param context
     * @param filePath
     * @param destination
     */
    public void SendFile(Context context, String filePath, String destination){
        this.context = context;
        this.fileAbsolutePath = filePath;
        this.destination = destination;
        new SendFileRequest().execute();
    }

    /**
     *
     */
    class SendFileRequest extends AsyncTask<String, Void, String> {

        protected void onPreExecute(){}

        protected String doInBackground(String... arg0) {

            try {

                URL url = new URL(destination); // here is your URL path

                //final String filePath = Environment.getExternalStorageDirectory().toString()+"/DCIM/Camera/Kams.jpg";
                final String filePath = fileAbsolutePath;

                DataOutputStream dataOutputStream;
                String lineEnd = "\r\n";
                String twoHyphens = "--";
                String boundary = "*****";

                int bytesRead,bytesAvailable,bufferSize;
                byte[] buffer;
                int maxBufferSize = 1 * 1024 * 1024;
                File selectedFile = new File(filePath);

                String[] parts = filePath.split("/");
                final String fileName = parts[parts.length-1];

                if (!selectedFile.isFile()){
                    //Toast.makeText(getApplicationContext(), "Source File Doesn't Exist: ", Toast.LENGTH_LONG).show();

                    return new String("Source File Doesn't Exist... ");
                }else {
                    FileInputStream fileInputStream = new FileInputStream(selectedFile);
                    HttpURLConnection conn = (HttpURLConnection) url.openConnection();
                    conn.setReadTimeout(15000 /* milliseconds */);
                    conn.setConnectTimeout(15000 /* milliseconds */);
                    conn.setRequestMethod("POST");
                    conn.setRequestProperty("Connection", "Keep-Alive");
                    conn.setRequestProperty("ENCTYPE", "multipart/form-data");
                    conn.setRequestProperty("Content-Type", "multipart/form-data;boundary=" + boundary);
                    conn.setRequestProperty("uploaded_file", filePath);
                    conn.setDoInput(true);
                    conn.setDoOutput(true);


                    dataOutputStream = new DataOutputStream(conn.getOutputStream());

                    dataOutputStream.writeBytes(twoHyphens + boundary + lineEnd);
                    dataOutputStream.writeBytes("Content-Disposition: form-data; name=\"photo\";filename=\""
                            + fileName + "\"" + lineEnd);

                    dataOutputStream.writeBytes(lineEnd);

                    bytesAvailable = fileInputStream.available();
                    bufferSize = Math.min(bytesAvailable, maxBufferSize);
                    buffer = new byte[bufferSize];
                    bytesRead = fileInputStream.read(buffer, 0, bufferSize);
                    while (bytesRead > 0) {
                        dataOutputStream.write(buffer, 0, bufferSize);
                        bytesAvailable = fileInputStream.available();
                        bufferSize = Math.min(bytesAvailable, maxBufferSize);
                        bytesRead = fileInputStream.read(buffer, 0, bufferSize);
                    }

                    dataOutputStream.writeBytes(lineEnd);
                    dataOutputStream.writeBytes(twoHyphens + boundary + twoHyphens + lineEnd);

                    int responseCode=conn.getResponseCode();

                    if (responseCode == HttpURLConnection.HTTP_OK) {

                        BufferedReader in=new BufferedReader(new
                                InputStreamReader(
                                conn.getInputStream()));

                        StringBuffer sb = new StringBuffer("");
                        String line="";

                        while((line = in.readLine()) != null) {

                            sb.append(line);
                            break;
                        }

                        in.close();
                        fileInputStream.close();
                        dataOutputStream.flush();
                        dataOutputStream.close();

                        if (conn != null) {
                            conn.disconnect();
                        }

                        return sb.toString();

                    }
                    else {
                        return new String("false : "+responseCode);
                    }
                }


            }
            catch(Exception e){
                return new String("Exception: " + e.getMessage());
            }

        }

        @Override
        protected void onPostExecute(String result) {
            Toast.makeText(context, result,
                    Toast.LENGTH_LONG).show();
        }
    }

    public String getPostDataString(JSONObject params) throws Exception {

        StringBuilder result = new StringBuilder();
        boolean first = true;

        Iterator<String> itr = params.keys();

        while(itr.hasNext()){

            String key= itr.next();
            Object value = params.get(key);

            if (first)
                first = false;
            else
                result.append("&");

            result.append(URLEncoder.encode(key, "UTF-8"));
            result.append("=");
            result.append(URLEncoder.encode(value.toString(), "UTF-8"));

        }
        return result.toString();
    }
}
