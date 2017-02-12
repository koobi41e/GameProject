using UnityEngine;
using System.Collections;
//attach this to an object in the unity file

public class tableOperations : MonoBehaviour
{
	// this is the secret key it MUST 
	// be the same here as in the php file
	private string secretKey = "mySecretKey";
	//------------------------------------

	// the URL that leads to the php file MUST
	// have a '?' at the end
	string URL = "http://koobigamesite.azurewebsites.net/?";	
	//------------------------------------
	char[] parsing= {'|',';'};
	int SUCCESS=0;
	WWW display;
	string placeholder;
	IEnumerator Start()
	{
		WWW display = new WWW(URL);
		yield return display;
		print(display.text);
		placeholder=display.text;
		SUCCESS=1;
	}


	public string username;
	public int team;
	void Update()
	{
		if(Input.GetKeyDown("r"))
		{
			SUCCESS=0;
			StartCoroutine(reLoad());
		}
		if(Input.GetKeyDown(KeyCode.Alpha1))
		{
			StartCoroutine(createT());
		}

		if(Input.GetKeyDown(KeyCode.Alpha2))
		{
			print("in2");
			StartCoroutine(makePlayer(username));
			print("Done");
		}

		if(Input.GetKeyDown(KeyCode.Alpha3))
		{
			StartCoroutine(deletePlayer(username));
		}

		if(Input.GetKeyDown(KeyCode.Alpha4))
		{
			StartCoroutine(setTeam(username, team));
		}

		if(Input.GetKeyDown(KeyCode.Alpha5))
		{
			StartCoroutine(updateKill(username));
		}

		if(Input.GetKeyDown(KeyCode.Alpha6))
		{
			StartCoroutine(updateDeaths(username));
		}

		if(Input.GetKeyDown(KeyCode.Alpha7))
		{
			StartCoroutine(incScore(username));
		}

		if(Input.GetKeyDown(KeyCode.Alpha8))
		{
			StartCoroutine(delete());
		}
	}

	void OnGUI()
	{	
		string[] parse1;
		//string post_url = URL;
		//WWW display = new WWW(post_url);
		//yield display;
		if(SUCCESS==0)
			GUI.Box(new Rect(0,0,100,100),"loading");
		if(SUCCESS==1)
		{
		parse1= placeholder.Split(parsing);

		GUI.Box(new Rect(0,0,100,100),parse1[0]);
		}
	}

	IEnumerator reLoad()
	{
		WWW display = new WWW(URL);
		yield return display;
		print(display.text);
		placeholder=display.text;
		SUCCESS=1;
	}

	// creates a unique table and returns the id
	// of the table.
	//creates a new table 
	//---------------------------------------------------------------------
	IEnumerator createT()
	{
		string post_url = URL + "operation=" + "create";
		WWW hs_post = new WWW(post_url);
		yield return hs_post;
		print("done");
	}
	//---------------------------------------------------------------------

	//adds a row into a certain table
	//---------------------------------------------------------------------
	IEnumerator makePlayer(string name)
	{
		print("in");
		string post_url = URL + "operation=" + "makePlayer" + "&name=" + name;
		WWW hs_post = new WWW(post_url);
		yield return hs_post;
		print("done");
	}
	//---------------------------------------------------------------------

	//removes a row into a certain table
	//---------------------------------------------------------------------
	IEnumerator deletePlayer(string name)
	{
		string post_url = URL + "operation=" + "deletePlayer" + "&name=" + name;
		WWW hs_post = new WWW(post_url);
		yield return hs_post;
		print("done");
	}
	//---------------------------------------------------------------------

	//updates a certain row
	//---------------------------------------------------------------------
	IEnumerator setTeam(string name, int NewValue)
	{
		string post_url = URL + "operation=" + "setTeam" + "&team=" + NewValue + "&name=" + name;
		WWW hs_post = new WWW(post_url);
		yield return hs_post;
		print("done");
	}

	IEnumerator updateKill(string name)
	{
		string post_url = URL + "operation=" + "updateKill" +"&name=" + name;
		WWW hs_post = new WWW(post_url);
		yield return hs_post;
		print("done");
	}

	IEnumerator updateDeaths(string name)
	{
		string post_url = URL + "operation=" + "updateDeath" + "&name=" + name;
		WWW hs_post = new WWW(post_url);
		yield return hs_post;
		print("done");
	}

	IEnumerator incScore(string name)
	{
		string post_url = URL + "operation=" + "incScores" + "&name="+name;
		WWW hs_post = new WWW(post_url);
		yield return hs_post;
		print("done");
	}
	//----------------------------------------------------------------------

	//deletes a certain table
	//----------------------------------------------------------------------
	IEnumerator delete()
	{
		string post_url = URL + "operation=" + "deleteTable";
		WWW hs_post = new WWW(post_url);
		yield return hs_post;
		print("done");
	}
	//----------------------------------------------------------------------

	//returns a string of the information on the database
	
	string[] parse1;
	//-----------------------------------------------------------------------
	string[] getdata()
	{
		StartCoroutine(getpost());
		while(SUCCESS!=1);
		print("getdata" + parse1[0]);	
		return parse1;
	}
	//-----------------------------------------------------------------------

	IEnumerator getpost()
	{
		string post_url = URL;
		WWW display = new WWW(post_url);
		yield return display;
		string placeholder=display.text;
		parse1= placeholder.Split(';');
		SUCCESS=1;


	}
	/*
	void getdata()
	{
		HttpClient site = httpClient();
		site.BaseAddress
	}
	*/
}