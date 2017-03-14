using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class WeaponSpawn : MonoBehaviour {

	public Transform[] spawnLocations;
	public GameObject[] weaponToSpawnPrefab;
	public GameObject[] weaponToSpawnClone;

	void Start(){  //Aaron B, script allows for easy weapon spawning of a variety of weapons
		spawnWeapon ();
	}

	void spawnWeapon(){
		weaponToSpawnClone[0]=Instantiate(weaponToSpawnPrefab[0], spawnLocations[0].transform.position, Quaternion.Euler(0,0,0)) as GameObject;
	}
}
