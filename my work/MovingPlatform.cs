using System.Collections;
using System.Collections.Generic;
using UnityEngine;


public class MovingPlatform : MonoBehaviour {
    //variables
    public GameObject platform;
    public float speed = 1;// speed of platform motion
    public Transform targetPoint;//where the platform will move to next
    public Transform[] points;// Number of translation points
    int pointSelection; // used to choose next point in points[]
    public bool repeat = true;
	
	void Start () {
        // gets possiton of platform during translation
        targetPoint = points[pointSelection];
    }
	
	// Update is called once per frame
	void Update () {
        // moves gameObject(the platform) to the target location
        platform.transform.position = Vector2.MoveTowards(platform.transform.position, targetPoint.position, Time.deltaTime * speed);

        //once platform reaches the target point switch to the next target point
        if (platform.transform.position == targetPoint.position && repeat)
        {
            pointSelection++;
            // sets to go back to start
            if (pointSelection >= points.Length && repeat)
            {
                pointSelection = 0;
            }
            targetPoint = points[pointSelection];
        }
	}
}
