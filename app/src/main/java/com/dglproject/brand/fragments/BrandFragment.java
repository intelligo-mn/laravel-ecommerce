package com.dglproject.brand.fragments;

import android.content.Intent;
import android.content.res.Configuration;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.GridView;
import android.widget.ProgressBar;
import android.widget.TextView;

import com.dglproject.brand.DglConstants;
import com.dglproject.brand.R;
import com.dglproject.brand.activity.ActivityProductList;
import com.dglproject.brand.adapters.BrandAdapter;

import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpUriRequest;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.params.HttpConnectionParams;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.MalformedURLException;
import java.util.ArrayList;

public class BrandFragment extends Fragment {

    public static final String ARG_PAGE = "ARG_PAGE";
    private int mPageNo;
    private static View rootView;

    GridView listBrand;
    ProgressBar bLoading;
    TextView bAlert;

    BrandAdapter brandAdapter;

    public static ArrayList<Long> Brand_ID = new ArrayList<Long>();
    public static ArrayList<String> Brand_name = new ArrayList<String>();
    public static ArrayList<String> Brand_image = new ArrayList<String>();

    String BrandAPI;
    int IOConnect = 0;

    public static BrandFragment newInstance(int pageNo) {

        Bundle args = new Bundle();
        args.putInt(ARG_PAGE, pageNo);
        BrandFragment fragment = new BrandFragment();
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        mPageNo = getArguments().getInt(ARG_PAGE);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        rootView = inflater.inflate(R.layout.fragment_brand, container, false);

        bLoading = (ProgressBar) rootView.findViewById(R.id.bLoading);
        listBrand = (GridView) rootView.findViewById(R.id.listBrand);
        bAlert = (TextView) rootView.findViewById(R.id.bAlert);

        brandAdapter = new BrandAdapter(getActivity());

        BrandAPI = DglConstants.BrandService+"?accesskey="+ DglConstants.AccessKey;

        new getDataTask().execute();

        listBrand.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            public void onItemClick(AdapterView<?> arg0, View arg1, int position,
                                    long arg3) {
                Intent brands = new Intent(getActivity(), ActivityProductList.class);
                brands.putExtra("brand_id", Brand_ID.get(position));
                brands.putExtra("brand_name", Brand_name.get(position));
                startActivity(brands);
            }
        });
        return  rootView;
    }


    void clearData(){
        Brand_ID.clear();
        Brand_name.clear();
        Brand_image.clear();
    }

    public class getDataTask extends AsyncTask<Void, Void, Void> {

        getDataTask(){
            if(!bLoading.isShown()){
                bLoading.setVisibility(0);
                bAlert.setVisibility(8);
            }
        }

        @Override
        protected Void doInBackground(Void... arg0) {
            parseJSONData();
            return null;
        }

        @Override
        protected void onPostExecute(Void result) {
            bLoading.setVisibility(8);

            if((Brand_ID.size() > 0) && (IOConnect == 0)){
                listBrand.setVisibility(0);
                listBrand.setAdapter(brandAdapter);
            }else{
                bAlert.setVisibility(0);
            }
        }
    }

    public void parseJSONData(){

        clearData();

        try {

            HttpClient client = new DefaultHttpClient();
            HttpConnectionParams.setConnectionTimeout(client.getParams(), 15000);
            HttpConnectionParams.setSoTimeout(client.getParams(), 15000);
            HttpUriRequest request = new HttpGet(BrandAPI);
            HttpResponse response = client.execute(request);
            InputStream atomInputStream = response.getEntity().getContent();
            BufferedReader in = new BufferedReader(new InputStreamReader(atomInputStream));

            String line;
            String str = "";
            while ((line = in.readLine()) != null){
                str += line;
            }

            JSONObject json = new JSONObject(str);
            JSONArray data = json.getJSONArray("data");

            for (int i = 0; i < data.length(); i++) {
                JSONObject object = data.getJSONObject(i);

                JSONObject category = object.getJSONObject("brand");

                Brand_ID.add(Long.parseLong(category.getString("brand_id")));
                Brand_name.add(category.getString("brand_name"));
                Brand_image.add(category.getString("brand_image"));
            }
        } catch (MalformedURLException e) {
            e.printStackTrace();
        } catch (IOException e) {
            IOConnect = 1;
            e.printStackTrace();
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    @Override
    public void onConfigurationChanged(final Configuration newConfig)
    {
        super.onConfigurationChanged(newConfig);
    }

}
