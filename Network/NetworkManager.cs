using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class NetworkManager : MonoBehaviour {
    // globals for name convention
    const string VERSION = "v0.1"; 
    public string roomName = "LevelZero"; 
    public string playerPrefabName = "PlayerOne";
    public Transform spawnPoint;

    // Photon Network initialization
    // works in pair of photon unity networking 
    void Start () {
        PhotonNetwork.ConnectUsingSettings(VERSION);
    }

    // join random room
    void OnJoinedLobby()
    {
        RoomOptions roomOptions = new RoomOptions() { isVisible = false, maxPlayers = 4 };
        PhotonNetwork.JoinOrCreateRoom(roomName, roomOptions, TypedLobby.Default);
    }

    // spawns playerPrefabName when joined room
    void OnJoinedRoom() {
        PhotonNetwork.Instantiate(playerPrefabName,
                                    spawnPoint.position,
                                    spawnPoint.rotation,
                                    0);
    }

}
