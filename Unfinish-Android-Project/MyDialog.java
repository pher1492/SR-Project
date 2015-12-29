package edu.olemiss.crmcmaho.p3crmcmaho;

import android.app.Activity;
import android.app.DialogFragment;
import android.graphics.Bitmap;
import android.net.Uri;
import android.os.Bundle;
import android.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import android.widget.TextView.OnEditorActionListener;

import java.io.ByteArrayOutputStream;


public class MyDialog extends DialogFragment implements View.OnClickListener {

    Button saveB, cancelB;
    Communicator communicator;
    private EditText editText;
    String name;

    @Override
    public void onAttach(Activity activity) {
        super.onAttach(activity);
        communicator = (Communicator) activity;
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle saveInstanceState){
        View view = inflater.inflate(R.layout.fragment_my_dialog, null);
        saveB = (Button) view.findViewById(R.id.saveButton);
        cancelB = (Button) view.findViewById(R.id.cancelButton);
        saveB.setOnClickListener(this);
        cancelB.setOnClickListener(this);
        editText = (EditText) view.findViewById(R.id.enterName);
        return view;

    }

    @Override
    public void onClick(View v) {
        if(v.getId()==R.id.saveButton){
            name = editText.getText().toString();
            communicator.commName(name);
            //Toast.makeText(getActivity(), "n: " + name, Toast.LENGTH_SHORT).show();
            dismiss();

        } else {
            communicator.onDialogMessage("Cancelled");
            dismiss();

        }
    }

    public void addImage(String name, Bitmap img){

        byte [] data = getBitmapAsByteArray(img);


    }

    public static byte[] getBitmapAsByteArray(Bitmap bitmap){
        ByteArrayOutputStream outputStream = new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.PNG, 0, outputStream);
        return outputStream.toByteArray();
    }

    interface Communicator {
        public void onDialogMessage(String message);
        public void commName(String name);
    }
}
