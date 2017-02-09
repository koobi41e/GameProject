using System.Collections;
using UnityEngine;

public class collection : MonoBehaviour
{  
     void OnTriggerEnter2D(BoxCollider2D coin)
    {
        if (coin.tag == "Coin") //when going over item with tag coin, it is destroyed.
        {
            Destroy(coin.gameObject);
            
        }
    }
}

