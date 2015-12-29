package edu.olemiss.crmcmaho.p3crmcmaho;

import android.app.Activity;
import android.app.FragmentManager;
import android.app.ListFragment;
import android.os.Bundle;
import android.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AbsListView;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListAdapter;
import android.widget.TextView;


import edu.olemiss.crmcmaho.p3crmcmaho.dummy.DummyContent;


public class NamesListFragment extends ListFragment implements AbsListView.OnItemClickListener {

    long _id;
    int _position;
    

    @Override
    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle saveInstanceState){
        View view = inflater.inflate(R.layout.fragment_names_list, null);
        return view;

    }


    public static final NamesListFragment newInstance(){
        NamesListFragment f = new NamesListFragment();
        return f;
    }
}
