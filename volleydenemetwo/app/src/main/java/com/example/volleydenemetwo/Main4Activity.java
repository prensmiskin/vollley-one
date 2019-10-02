package com.example.volleydenemetwo;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class Main4Activity extends AppCompatActivity {
    Button go;
    TextView textview,akisone,akistwo;
    EditText akis,edit;
    private RequestQueue mQueue;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main4);
        go = findViewById(R.id.go);
        textview = findViewById(R.id.textview);
        akisone = findViewById(R.id.akisone);
        akistwo= findViewById(R.id.akistwo);
        akis = findViewById(R.id.akis);
        edit = findViewById(R.id.edit);
        mQueue = Volley.newRequestQueue(this);

        jsonParse();
        //Intent i = getIntent();
     //   String extraName = i.getStringExtra("sesion");
//        akisone.setText(extraName);


        go.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                kisiekle();

            }
        });

    }
    public void kisiekle(){
        String url = "https://goldgym.pro/akis.php";
        final String akiss = akis.getText().toString().trim();


        StringRequest istek = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Log.e("Cevap",response);

                try{
                    JSONObject jsonObject = new JSONObject(response);
                    JSONArray movies = jsonObject.getJSONArray("employees");




                    StringBuilder sb = new StringBuilder();

                  for (int i=0; i < movies.length();i++){
                        JSONObject b = movies.getJSONObject(i);

                       String akis_ad = b.getString("akis");


                      akisone.append(akis_ad + ","  + "\n\n");





                    }








                } catch (JSONException e){
                    e.printStackTrace();

                }





            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

            }
        }){

            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String,String> params = new HashMap<>();

                params.put("akis",akiss);

                return params;
            }
        };
        Volley.newRequestQueue(this).add(istek);


    }
    public void acil(){
        Toast.makeText(getApplicationContext(),"Kayıt Başarılı",Toast.LENGTH_SHORT).show();



        //Intent i = new Intent(getBaseContext(), Main2Activity.class);
       // startActivity(i);

       // textview.setText("tamamdır");

    }
    private void jsonParse(){



        String url  ="https://goldgym.pro/akis.php";
        JsonObjectRequest request = new JsonObjectRequest(Request.Method.POST, url, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray = response.getJSONArray("employees");
                            for (int i = 0; i < jsonArray.length();i++){

                                JSONObject employee = jsonArray.getJSONObject(i);
                                String akis = employee.getString("akis");
                                //String lastName = employee.getString("lastName");

                                akisone.append(akis + ","  + "\n\n");
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();

            }
        });

        mQueue.add(request);


    }
}
