using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityStandardAssets._2D;

public class bulletScript : Photon.MonoBehaviour {
	
	public float speed = 6;
	public string objectName ="bullet";
    private List<GameObject> Projectiles = new List<GameObject>();
    int facing = 1;
    void fire()
	{
        if (PlatformerCharacter2D.facing)
            facing = 1;
        else
            facing = -1; 

		GameObject bullet = PhotonNetwork.Instantiate (objectName, transform.position, transform.rotation,0);
        Rigidbody2D RB_bull = bullet.GetComponent<Rigidbody2D>();
		RB_bull.velocity = new Vector2(speed*facing,0);
    }

	// Update is called once per frame
    
	void Update () {
        if(Input.GetKeyDown(KeyCode.Z))
        {
            fire();
        }        
        /*
        if (Input.GetKeyDown(KeyCode.Z)|| Input.GetKeyDown(KeyCode.Mouse0))
        {
            GameObject bulletClone =  Instantiate(bullet, transform.position, Quaternion.identity);
            //bulletClone.velocity = transform.forward * speed;
            Projectiles.Add(bulletClone);
            if (PlatformerCharacter2D.facing)
            {
                facing = 1;
            }
            else { facing = -1; }
        }
        for (int i = 0; i < Projectiles.Count; i++)
        {
            GameObject goBullet = Projectiles[i];
            if(goBullet != null)
            {
                goBullet.transform.Translate(new Vector2(facing, 0) * Time.deltaTime * speed);

                Vector2 bulletPos = Camera.main.WorldToScreenPoint(goBullet.transform.position);
                if(bulletPos.x > Screen.width*2)
                {
                    DestroyObject(goBullet);
                    Projectiles.Remove(goBullet);
                }
            }

        }
        */
    }
}