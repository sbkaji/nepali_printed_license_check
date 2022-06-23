import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.IOException;
import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Scanner;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JTextField;

import org.json.JSONArray;
import org.json.JSONObject;

public class Licjson {

	  private static String streamToString(InputStream inputStream) {
		    @SuppressWarnings("resource")
			String text = new Scanner(inputStream, "UTF-8").useDelimiter("\\Z").next();
		    return text;
		  }

		  public static String jsonGetRequest(String urlQueryString) {
		    String json = null;
		    try {
		      URL url = new URL(urlQueryString);
		      HttpURLConnection connection = (HttpURLConnection) url.openConnection();
		      connection.setDoOutput(true);
		      connection.setInstanceFollowRedirects(false);
		      connection.setRequestMethod("GET");
		      connection.setRequestProperty("Content-Type", "application/json");
		      connection.setRequestProperty("charset", "utf-8");
		      connection.connect();
		      InputStream inStream = connection.getInputStream();
		      json = streamToString(inStream); // input stream to string
		    } catch (IOException ex) {
		      ex.printStackTrace();
		    }
		    return json;
			}
	public static void main(String[] args) {
		// TODO Auto-generated method stub
		
		JFrame frame = new JFrame("Test");
        frame.setVisible(true);
        frame.setSize(300, 300);
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        JLabel label = new JLabel("hello");
        JPanel panel = new JPanel();
        frame.add(panel);
        panel.add(label);
        
        final JTextField input = new JTextField(9); // The input field with a width of 5 columns
        panel.add(input);
	
        JButton button = new JButton("Check");
        panel.add(button);
        final JLabel output = new JLabel(); 
        final JLabel output2 = new JLabel();
        final JLabel output3 = new JLabel();
        final JLabel output4 = new JLabel();
        final JLabel output5 = new JLabel();
        final JLabel output6 = new JLabel();
        final JLabel output7 = new JLabel();// A label for your output
        panel.add(output);
        panel.add(output2);
        panel.add(output3);
        panel.add(output4);
        panel.add(output5);
        panel.add(output6);
        panel.add(output7);
       
        
        button.addActionListener(new ActionListener() { // The action listener which notices when the button is pressed
        	public void actionPerformed(ActionEvent e) {
                String dlno = input.getText();
                   // output.setText("Hi youngster!");	
        			try {
        				String js=(jsonGetRequest("https://dotm.gov.np/CheckLicense/ShowDetails?name=&DlNo="+ dlno +"&_=1655698386810"));
        				JSONArray jsonarray = new JSONArray(js);
        					output.setText("<html>Congrats your license is printed</br></html>");
        				    JSONObject jsonobject = jsonarray.getJSONObject(0);
        				    String name = jsonobject.getString("Name");
        				    int appid = jsonobject.getInt("DLId");
        				    String dlnos = jsonobject.getString("DINo");
        				    String dis = jsonobject.getString("DispatchDate");
        				    String dbranch = jsonobject.getString("SentBranch");
        				    String dtype = jsonobject.getString("Type");
        				    System.out.println("Name: " + name);
        				    output2.setText("Name: " + name);
        				    System.out.println("Applicant ID: " + appid);
        				    output3.setText("Applicant ID: " + appid);
        				    System.out.println("License Type: " + dtype);
        				    output4.setText("License Type: " + dtype);
        				    System.out.println("License No: " +dlnos);
        				    output5.setText("License No: " +dlnos);
        				    System.out.println("Printed Date: " +dis);	
        				    output6.setText("Printed Date: " +dis);
        				    System.out.println("Sent Branch: " +dbranch);   
        				    output7.setText("Sent Branch: " +dbranch);
        			} catch (Exception e1) {
        				// TODO Auto-generated catch block
        				output.setText("<html><b>Sorry Not Printed</b></br></html>");
        			}	 
            }	
        });
		
  }



	

}
