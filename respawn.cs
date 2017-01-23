using System;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class respawn : MonoBehaviour {

    public Vector2 Spawn_pos1;  // position to spawn
    public int clock = 0;       // used as placeholder factor
    // public bool respawn = false;

	// Update is called once per frame
	void Update () {
        clock++;
        if (this.isDead()) {
            // when dead, transform position
            transform.position = Spawn_pos1;
            clock = 0;
        }
    }

    bool isDead () {
        // factor for determining if dead
        if (clock > 3000)
        {
            return true;
        }
        return false;
    }
}
