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
	static string URL = "http://koobigamesite.azurewebsites.net/?";
	//------------------------------------

	static string[] parsing;
	static char[] parser = {'|',';'};

	//adds a row into a certain table
	// public static IEnumerator makePlayer(string name, string TBName)
	// name is the name of a player
	// TBName is the name of the table that the player is to be added
	//---------------------------------------------------------------------
	public static IEnumerator makePlayer(string name, string TBName)
	{
		string post_url = URL + "operation=" + "makePlayer" + "&playerName=" + name + "&kills=" + 0 + "&deaths=" + 0 + "&score=" + 0 + "&team=" + 0 + "&TBName=" + TBName;
		WWW hs_post = new WWW(post_url);
		yield return hs_post;
	}
	//---------------------------------------------------------------------

	//updates a certain row
	//---------------------------------------------------------------------
	//public static IEnumerator updateTeam(string name, int NewValue, string TBName)
	// name is the name of the player to ba updated
	// NewValue is the value to which the team will be changed to.
	// TBName is the table in which the player exists
	public static IEnumerator updateTeam(string name, int NewValue, string TBName)
	{
		string post_url = URL + "operation=" + "updateTeam" + "&team=" + NewValue + "&name=" + name + "&TBName=" + TBName;
		WWW hs_post = new WWW(post_url);
		yield return hs_post;
	}

	//public static IEnumerator updateKills(string name, int NewValue, string TBName)
	// name; the name of the player to be updated
	// TBName; the name of the table in which the player exists
	// this function incraments by one
	public static IEnumerator updateKills(string name, string TBName)
	{
		string post_url = URL + "operation=" + "updateKills" + "&name=" + name + "&TBName=" + TBName;
		WWW hs_post = new WWW(post_url);
		yield return hs_post;
	}

	//public static IEnumerator updateDeaths(string name, string TBName)
	// name; the name of the player to be updated
	// TBName; the name of the table in which the player exists
	// this function updates by one
	public static IEnumerator updateDeaths(string name, string TBName)
	{
		string post_url = URL + "operation=" + "updateDeaths" + "&name=" + name + "&TBName=" + TBName;
		WWW hs_post = new WWW(post_url);
		yield return hs_post;
	}

	//public static IEnumerator updateScore(string name, int NewValue, string TBName)
	// name; the name of the player to be updated
	// TBName; the name of the table in which the player exists
	// NewValue; is the value that the score will be changed to
	public static IEnumerator updateScore(string name, int NewValue, string TBName)
	{
		string post_url = URL + "operation=" + "updateScore" + "&score=" + NewValue + "&name=" + name + "&TBName=" + TBName;
		WWW hs_post = new WWW(post_url);
		yield return hs_post;
	}
	//----------------------------------------------------------------------

	//deletes a certain table
	//----------------------------------------------------------------------
	//public static IEnumerator delete(string TBName)
	// TBName is the name of the table to be deleted
	public static IEnumerator delete(string TBName)
	{
		string post_url = URL + "operation=" + "delete" + "&TBName=" + TBName;
		WWW hs_post = new WWW(post_url);
		yield return hs_post;
	}
	//----------------------------------------------------------------------

	//creates table
	//----------------------------------------------------------------------
	//public static IEnumerator createT(string TBName)
	public static IEnumerator createT(string TBName)
	{
		string post_url = URL + "operation=" + "create" + "&TBName=" + TBName;
		WWW hs_post = new WWW(post_url);
		yield return hs_post;
	}
	//---------------------------------------------------------------------

	// gets data from a certain table
	//----------------------------------------------------------------------
	private static IEnumerator show(string TBName)
	{
		string post_url = URL + "operation=" + "showData" + "&TBName=" + TBName;
		WWW hs_post = new WWW(post_url);
		yield return hs_post;
		string temp = hs_post.text;
		parsing = temp.Split(parser);
	}

	private static string[] getData()
	{
		return parsing;
	}
	
	//public string[] dataGet(string TBName)
	//TBName is the table from which the data will be retrived.
	public string[] dataGet(string TBName)
	{
		StartCoroutine(show(TBName));
		return getData();
	}
	//----------------------------------------------------------------------
}