// Add to PlatformUser2dControl.cs
// README: This script implements a boost system that launches the user in the direction travelling
// Default Controls: Z

private float buttonCooler = 0.5f;
private int buttonCount = 0;
public bool isBoost = false;


private void checkBoost(float h, bool crouch, bool m_Jump)
{
    if (Input.GetKey(KeyCode.Z))
    {
        if (buttonCooler > 0 && buttonCount == 3)
        {
            //has dbl tapped
            isBoost = true;
            m_Character.Move(h * 5, crouch, m_Jump);
            Console.WriteLine("BOOST!");
        }
        else
        {
            buttonCooler = 0.5f;
            buttonCount += 1;
        }
    }
    else
    {
        isBoost = false;
    }
           
    if (buttonCooler > 0)
    {
        buttonCooler -= 1 * Time.deltaTime;
    }
    else
    {
        buttonCount = 0;
    }
}
