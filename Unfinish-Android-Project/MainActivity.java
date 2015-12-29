package edu.olemiss.crmcmaho.p3crmcmaho;

import android.app.FragmentManager;
import android.app.FragmentTransaction;
import android.content.Intent;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.drawable.BitmapDrawable;
import android.net.Uri;
import android.provider.MediaStore;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Toast;
import android.support.v4.app.FragmentActivity;

import java.io.ByteArrayOutputStream;



public class MainActivity extends ActionBarActivity implements MyDialog.Communicator {


    SQLiteDatabase db;
    private static int RESULT_LOAD_IMG = 1;
    String imgDecodableString, name;
    ImageView imgView;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


        db = openOrCreateDatabase("Temp.db", SQLiteDatabase.CREATE_IF_NECESSARY, null);
        try{
            final String CREATE_TABLE_CONTAIN = "CREATE TABLE IF NOT EXISTS photo ("
                    + "ID INTEGER primary key AUTOINCREMENT, "
                    + "NAME TEXT, "
                    + "PHOTO TEXT);";
            db.execSQL(CREATE_TABLE_CONTAIN);

            Toast.makeText(MainActivity.this, "table created", Toast.LENGTH_SHORT).show();

        } catch (Exception e){
            Toast.makeText(MainActivity.this, "Error: " + e.toString(), Toast.LENGTH_LONG).show();
        }
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        } else if (id == R.id.drop_setting){
            try {
                final String DROP_TABLE = "DROP TABLE if exists photo";
                db.execSQL(DROP_TABLE);
                Toast.makeText(MainActivity.this, "table dropped", Toast.LENGTH_SHORT).show();
                return true;
            }
            catch (Exception e){
                Toast.makeText(MainActivity.this, "Error: " + e.toString(), Toast.LENGTH_LONG).show();
            }

        } else if (id == R.id.add_setting){
            try{
                final String CREATE_TABLE_CONTAIN = "CREATE TABLE IF NOT EXISTS photo ("
                        + "ID INTEGER primary key AUTOINCREMENT, "
                        + "NAME TEXT, "
                        + "PHOTO TEXT);";
                db.execSQL(CREATE_TABLE_CONTAIN);

                Toast.makeText(MainActivity.this, "table created", Toast.LENGTH_SHORT).show();

            } catch (Exception e){
                Toast.makeText(MainActivity.this, "Error: " + e.toString(), Toast.LENGTH_LONG).show();
            }
        }

        return super.onOptionsItemSelected(item);
    }



    public void showDialog(View v){
        FragmentManager manager = getFragmentManager();
        MyDialog myDialog = new MyDialog();
        myDialog.show(manager, "myDialog");
    }


    public void loadImagefromGallery(View view) {
        // Create intent to Open Image applications like Gallery, Google Photos
        Intent galleryIntent = new Intent(Intent.ACTION_PICK,
                android.provider.MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
        // Start the Intent
        startActivityForResult(galleryIntent, RESULT_LOAD_IMG);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        try {
            // When an Image is picked
            if (requestCode == RESULT_LOAD_IMG && resultCode == RESULT_OK
                    && null != data) {
                // Get the Image from data

                Uri selectedImage = data.getData();
                String[] filePathColumn = { MediaStore.Images.Media.DATA };

                // Get the cursor
                Cursor cursor = getContentResolver().query(selectedImage,
                        filePathColumn, null, null, null);
                // Move to first row
                cursor.moveToFirst();

                int columnIndex = cursor.getColumnIndex(filePathColumn[0]);
                imgDecodableString = cursor.getString(columnIndex);
                cursor.close();
                imgView = (ImageView) findViewById(R.id.imageView);
                // Set the Image in ImageView after decoding the String
                imgView.setImageBitmap(BitmapFactory
                        .decodeFile(imgDecodableString));

                imgView.setOnLongClickListener(new View.OnLongClickListener() {

                    @Override
                    public boolean onLongClick(View v) {
                        FragmentManager manager = getFragmentManager();
                        MyDialog myDialog = new MyDialog();
                        myDialog.show(manager, "myDialog");
                        return true;
                    }
                });

            } else {
                Toast.makeText(this, "You haven't picked Image",
                        Toast.LENGTH_LONG).show();
            }
        } catch (Exception e) {
            Toast.makeText(this, "Something went wrong", Toast.LENGTH_LONG)
                    .show();
        }

    }


    @Override
    public void onDialogMessage(String message) {
        Toast.makeText(this, message, Toast.LENGTH_SHORT).show();
    }

    public void openList(View v){
        Intent listView = new Intent(this, ListViewActivity.class);
        startActivity(listView);
    }


    public void showGrid(View v){
        Intent gridView = new Intent(this, GridViewAct.class);
        startActivity(gridView);
    }

    @Override
    public void commName(String n) {
        name = n;
        Bitmap photo = ((BitmapDrawable)imgView.getDrawable()).getBitmap();
        ByteArrayOutputStream bos = new ByteArrayOutputStream();
        photo.compress(Bitmap.CompressFormat.PNG, 100, bos);
        byte[] bArray = bos.toByteArray();
       // Toast.makeText(this, name, Toast.LENGTH_LONG).show();
        try{

            String sql = "INSERT INTO photo (NAME, PHOTO) VALUES ('" + name +"', '"+bArray+"')";
            db.execSQL(sql);
            Toast.makeText(this, "Added: " + name, Toast.LENGTH_SHORT).show();
        }
        catch (Exception e){
            Toast.makeText(MainActivity.this, "Error: " + e.toString(), Toast.LENGTH_LONG).show();

        }

    }


//    long click on image view
//    @Override
//    public boolean onLongClick(View v) {
//        if (v.getId()== R.id.imageView){
//            FragmentManager manager = getFragmentManager();
//            MyDialog myDialog = new MyDialog();
//            myDialog.show(manager, "myDialog");
//            return true;
//        }
//        return false;
//    }


}
