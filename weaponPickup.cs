using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityStandardAssets._2D;

public class weaponPickup : Photon.MonoBehaviour
{

    public static bool hasGun = false;

   /* void OnTriggerEnter(Collider2D other)
    {
        if (Input.GetKeyDown(KeyCode.X) && (other.GetComponent<GameObject>().tag == "gun")) //if you press and over a weapon
        {
            other.transform.parent = this.transform; //makes gun a child of the character 
            hasGun = true;
            DestroyObject(other.gameObject);
        }

    }*/
	//void Start(){
	//	enabled = 
	//}


    void OnTriggerStay2D(Collider2D other)
    {
		if (!photonView.isMine) 
		{
			return;
		}
        int id = PhotonNetwork.player.ID;
        print(id);
        if (PhotonNetwork.player.ID==id)
		{
			if (Input.GetKeyDown (KeyCode.X) && other.transform.tag == "gun" && hasGun == false) {
				//transform.parent = other.transform;
				hasGun = true;
                WeaponSpawn.spawned = -1;//Thomas// Tells WeaponSpawn that the item has been picked up
				//----------------
				// why are we dystoring the gun and not attaching it to the player?
				//----------------
				GameObject gun;
				gun = other.gameObject;
				Vector2 gunScale;
				if(transform.localScale.x<0)
				{
					Debug.Log("flip gun");
					gunScale = gun.transform.localScale;
					gunScale.x = gunScale.x*-1;
					gun.transform.localScale = gunScale;
				}
				gun.transform.position = transform.position;
				gun.transform.parent = transform;
				//----------------
				
			}
        }
    }
}