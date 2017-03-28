//author: Earl & Koobi
//editor:
//summary


using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class findWinner : MonoBehaviour {

    public Text winText;
	// Koobi please change this to the correct URL
	string URL = "http://koobigamesite.azurewebsites.net/?operation=highestScore";
	string placeholder;
	int SUCCESS = 0;
	//these are the parsing rules
	char[] parsing= {'|',';'};
	string[] parse1;

	// Use this for initialization
	void Start () 
	{
	}
	
	// Update is called once per frame
	void Update () 
	{
		if (SUCCESS == 0)
		{
			StartCoroutine(loadWinner());
		}
	}

	/*void OnGUI()
	{
		// Koobi please edit this to where it will display like you want it to//
		if(SUCCESS==0)// this is for when the data is not loaded
		{	
			//Rect(top left x position, top left y position, x length, y length)
			GUI.Box(new Rect(0,0,100,100),"loading");
		}
		if(SUCCESS==1)
		{
			//GUI.Box(new Rect(0,0,100,100),parse1[0]);
		}
	}*/     //EARL

	IEnumerator loadWinner()
	{
		//string post_url = URL;
		WWW hs_post = new WWW(URL);
		yield return hs_post;
		placeholder = hs_post.text;
		parse1 = placeholder.Split(parsing);
        winText.text = "WINNER: " + parse1[0];
        if (parse1[0]==null)
		{
			SUCCESS = 0;
		}
		else
		{
			SUCCESS = 1;
        }
	}
}
