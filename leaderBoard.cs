//Author: Earl, Jose
//Editor:
// displays the entirer leaderboard
using UnityEngine;
using System.Collections;
//=====================================
// Koobi this should do what you wanted and display a leaderboard
// and for our game for players are nessicary so this should work
// <<<<< ALSO THIS IS THE FIRST TIME OF ME HEARING THAT YOU NEEDED THIS
// <<<<< SO NEXT TIME YOU DO THIS I WONT DO IT.
//======================================
public class leaderBoard : MonoBehaviour
{
	int success = 0;
	int gotData = 0;
	string[] data = null;

	// variable controls the curent volume
	//private float sliderVal = .5f;
	// instance of level manager usd to switch between menus
	private LevelManager man;
	//Name of Scene you want to go to
	public string sceneName;

	private tableOperations tab;
	

	void Updating()
	{
		if(success == 0)
		{
			if(gotData == 0)
			{
				data = tab.dataGet("leaderboards");
				gotData = 1;
			}
			
			if(data != null)
			{
				success = 1;
				gotData = 0;
			}
		}
	}

	void OnGUI()
	{
		//VARs
		//screen data
		float height = Screen.height;
		float width = Screen.width;
		//Column data
		float columnSize = .125f;
		float column1OffSet = .225f;
		float column2OffSet = column1OffSet + columnSize;
		float column3OffSet = column2OffSet + columnSize;
		float column4OffSet = column3OffSet + columnSize;
		float column5OffSet = column4OffSet + columnSize;

		//Row Data
		float rowSize = .1f;
		float row1OffSet = .375f;
		float row2OffSet = row1OffSet + rowSize;
		float row3OffSet = row2OffSet + rowSize;
		float row4OffSet = row3OffSet + rowSize;
		float header = row1OffSet - rowSize;

		//displays the loaded screen

		if(Input.GetKey(KeyCode.Q))
        {
			if (success == 0) {
				Updating ();
			}
			if (success == 1) {

				GUI.Box (new Rect (width * .2f, height * .2f, width * .6f, height * .6f), "LEADERBOARD");
				// header
				GUI.Label (new Rect (width * column1OffSet, height * header, width * columnSize, height * rowSize), "Name");
				GUI.Label (new Rect (width * column2OffSet, height * header, width * columnSize, height * rowSize), "Kills");
				GUI.Label (new Rect (width * column3OffSet, height * header, width * columnSize, height * rowSize), "Deaths");
				GUI.Label (new Rect (width * column4OffSet, height * header, width * columnSize, height * rowSize), "Score");
				GUI.Label (new Rect (width * column5OffSet, height * header, width * columnSize, height * rowSize), "Team");
				// row 1
				GUI.Label (new Rect (width * column1OffSet, height * row1OffSet, width * columnSize, height * rowSize), data [0]);
				GUI.Label (new Rect (width * column2OffSet, height * row1OffSet, width * columnSize, height * rowSize), data [1]);
				GUI.Label (new Rect (width * column3OffSet, height * row1OffSet, width * columnSize, height * rowSize), data [2]);
				GUI.Label (new Rect (width * column4OffSet, height * row1OffSet, width * columnSize, height * rowSize), data [3]);
				GUI.Label (new Rect (width * column5OffSet, height * row1OffSet, width * columnSize, height * rowSize), data [4]);
				if (data [5] != "") {
					// row 2
					GUI.Label (new Rect (width * column1OffSet, height * row2OffSet, width * columnSize, height * rowSize), data [5]);
					GUI.Label (new Rect (width * column2OffSet, height * row2OffSet, width * columnSize, height * rowSize), data [6]);
					GUI.Label (new Rect (width * column3OffSet, height * row2OffSet, width * columnSize, height * rowSize), data [7]);
					GUI.Label (new Rect (width * column4OffSet, height * row2OffSet, width * columnSize, height * rowSize), data [8]);
					GUI.Label (new Rect (width * column5OffSet, height * row2OffSet, width * columnSize, height * rowSize), data [9]);
				}
				if (data [10] != "") {
					// row 3
					GUI.Label (new Rect (width * column1OffSet, height * row3OffSet, width * columnSize, height * rowSize), data [10]);
					GUI.Label (new Rect (width * column2OffSet, height * row3OffSet, width * columnSize, height * rowSize), data [11]);
					GUI.Label (new Rect (width * column3OffSet, height * row3OffSet, width * columnSize, height * rowSize), data [12]);
					GUI.Label (new Rect (width * column4OffSet, height * row3OffSet, width * columnSize, height * rowSize), data [13]);
					GUI.Label (new Rect (width * column5OffSet, height * row3OffSet, width * columnSize, height * rowSize), data [14]);
				}
				if (data [15] != "") {
					// row 4
					GUI.Label (new Rect (width * column1OffSet, height * row4OffSet, width * columnSize, height * rowSize), data [15]);
					GUI.Label (new Rect (width * column2OffSet, height * row4OffSet, width * columnSize, height * rowSize), data [16]);
					GUI.Label (new Rect (width * column3OffSet, height * row4OffSet, width * columnSize, height * rowSize), data [17]);
					GUI.Label (new Rect (width * column4OffSet, height * row4OffSet, width * columnSize, height * rowSize), data [18]);
					GUI.Label (new Rect (width * column5OffSet, height * row4OffSet, width * columnSize, height * rowSize), data [19]);
				}
			} 
			else {
				success = 0;
			}
		}
	}
}