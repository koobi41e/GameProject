using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class ItemTrigger : MonoBehaviour {

    public Sprite testtrig1;
    public Sprite testtrig2;
    public Sprite empty;

    private void OnTriggerEnter2D(Collider2D other) {
        if (other.GetComponent<BoxCollider2D>().tag == "Player")
            this.gameObject.GetComponent<SpriteRenderer>().sprite = testtrig2;
    }


    // Checks for player collision
    private void OnTriggerStay2D(Collider2D other) {
        if (other.GetComponent<BoxCollider2D>().tag == "Player")
        {
            if (Input.GetKeyDown(KeyCode.X))
                this.gameObject.GetComponent<SpriteRenderer>().sprite = empty;
        }
    }

    private void OnTriggerExit2D(Collider2D other){
        this.gameObject.GetComponent<SpriteRenderer>().sprite = testtrig1;
    }

    // Use this for initialization
    void Start () {
        this.gameObject.GetComponent<SpriteRenderer>().sprite = testtrig1;
    }

    // Update is called once per frame
    void Update() {

    }

}
