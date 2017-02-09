using System;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using Random = UnityEngine.Random;

public class respawn : MonoBehaviour {

    public bool coin = false;
    public bool isDead = false;

    public Vector2[] spawnPoints;
    public int Location = 0, lastLocation;
    private int score = 0;
    public int scoreRespawnAt = 400;
    private int clock = 0;       // used as placeholder factor
                                 // public bool respawn = false;

/*
Attempting to add respawn delay to OBJ's
    void Start()
    {
        StartCoroutine(Example(5));
    }

    IEnumerator Example(num)
    {
        print(Time.time);
        yield return new WaitForSeconds(num);
        print(Time.time);
    }
*/

// Update is called once per frame
void Update() {
        clock++;

        /*recent change*/
        if (coin && isDead) //randomly chooses where the coin spawns based off of spawnPoints
        {
            lastLocation = Location;
            Location = Random.Range(0, spawnPoints.Length);
            while (Location == lastLocation)//Error check to see if it's in the same place then changes it
            {
                Location = Random.Range(0, spawnPoints.Length);
            }
            /*
Accompanies other spawn delay for OBJ
            Example(5);
            */
            transform.position = spawnPoints[Location];
            isDead = false;
        }

        if (isDead && !coin) {

                if (Location >= spawnPoints.Length)
                {
                    Location = 0;
                }

                // when dead, transform position
                transform.position = spawnPoints[Location];

                clock = 0;
                Location++;
                isDead = false;
            }

        } 



    void OnTriggerStay2D(Collider2D other)//when object is entered activate
    {
        if (other.gameObject.tag == "Player" || other.gameObject.tag == "test" )
        {
            score++;
        }
        if (score >= scoreRespawnAt)
        {
            isDead = true;
            score = 0;
        }
    }
    // on killbox collison change to isDead(true)
    void OnCollisionEnter2D(Collision2D hit)
    {
        if (hit.gameObject.tag == "KillBox")
        {
            isDead = true;
        }
        
    }
}
