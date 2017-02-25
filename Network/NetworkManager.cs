using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class NetworkManager : MonoBehaviour {
    const string VERSION = "v0.1";
    public string roomName = "LevelZero";
    public string playerPrefabName = "PlayerOne";
    public Transform spawnPoint;

	// Use this for initialization
	void Start () {
        PhotonNetwork.ConnectUsingSettings(VERSION);
    }

    void OnJoinedLobby()
    {
        RoomOptions roomOptions = new RoomOptions() { isVisible = false, maxPlayers = 4 };
        PhotonNetwork.JoinOrCreateRoom(roomName, roomOptions, TypedLobby.Default);
    }

    void OnJoinedRoom() {
        PhotonNetwork.Instantiate(playerPrefabName,
                                    spawnPoint.position,
                                    spawnPoint.rotation,
                                    0);
    }

}
