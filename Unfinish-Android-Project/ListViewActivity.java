package edu.olemiss.crmcmaho.p3crmcmaho;

import android.app.ListActivity;
import android.content.Intent;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.SimpleCursorAdapter;
import android.widget.Toast;

import java.util.Timer;


public class ListViewActivity extends ActionBarActivity  {
    ListView listView;
    Comunicator communicator;
    String selectSQL;


    SQLiteDatabase db;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_list_view);

        // Get ListView object from xml
        listView = (ListView) findViewById(R.id.list);

        db = openOrCreateDatabase("Temp.db", SQLiteDatabase.CREATE_IF_NECESSARY, null);
        Cursor crs = db.rawQuery("SELECT * FROM photo", null);

        String[] values = new String[crs.getCount()];
        int i = 0;
        while (crs.moveToNext()) {
            String uname = crs.getString(crs.getColumnIndex("NAME"));
            values[i] = uname;
            i++;
        }


        ArrayAdapter<String> adapter = new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1, android.R.id.text1, values);


        listView.setAdapter(adapter);

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                int itemPosition = position;


                String itemValue = (String) listView.getItemAtPosition(position);
                selectSQL = "SELECT * FROM photo WHERE NAME = '" + itemValue +"';";

                //Toast.makeText(getApplicationContext(), "ListItem : " + itemValue, Toast.LENGTH_LONG).show();
                Intent gridView = new Intent(ListViewActivity.this, GridViewAct.class);
                startActivity(gridView);

            }

        });


        listView.setOnItemLongClickListener(new AdapterView.OnItemLongClickListener() {

            @Override
            public boolean onItemLongClick(AdapterView<?> parent, View view, int position, long id) {
                int itemPosition = position;
                String itemValue = (String) listView.getItemAtPosition(position);
                final String deleteItem = "DELETE FROM photo WHERE NAME = '" + itemValue +"';";
                db.execSQL(deleteItem);
                Toast.makeText(getApplicationContext(), "go back and come back for updated list", Toast.LENGTH_SHORT).show();
                return true;
            }
        });
    }

    interface Comunicator{
        public void commItem(String selectSQL);
    }

}


