package com.cybertimeup.appjogodavelha

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.View
import android.widget.Button
import android.widget.Toast

class MainActivity : AppCompatActivity() {

    val playerOne = arrayListOf<Int>()
    val playerTwo = arrayListOf<Int>()
    var currentPlayer = 1

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
    }

    fun play(position: Int, btnSelected: Button) {

        if (currentPlayer == 1) {
            btnSelected.text = "X"
            btnSelected.setBackgroundResource(R.color.colorPlayer1)
            playerOne.add(position)
            currentPlayer = 2
        } else {
            btnSelected.text = "O"
            btnSelected.setBackgroundResource(R.color.colorPlayer2)
            playerTwo.add(position)
            currentPlayer = 1
        }

        btnSelected.isClickable = false

        checkResult()
    }

    fun btnPosition(view: View) = when(view.id) {
        R.id.btn1 -> play(1, view as Button)
        R.id.btn2 -> play(2, view as Button)
        R.id.btn3 -> play(3, view as Button)
        R.id.btn4 -> play(4, view as Button)
        R.id.btn5 -> play(5, view as Button)
        R.id.btn6 -> play(6, view as Button)
        R.id.btn7 -> play(7, view as Button)
        R.id.btn8 -> play(8, view as Button)
        R.id.btn9 -> play(9, view as Button)
        else -> play(0, view as Button)
    }

    fun checkResult() {
        val row1 = listOf(1,2,3)
        val row2 = listOf(4,5,6)
        val row3 = listOf(7,8,9)

        val col1 = listOf(1,4,7)
        val col2 = listOf(2,5,8)
        val col3 = listOf(3,6,9)

        val diag1 = listOf(1,5,9)
        val diag2 = listOf(3,5,7)

        var winner = -1

        if (playerOne.containsAll(row1) || playerOne.containsAll(row2) || playerOne.containsAll(row3) ||
            playerOne.containsAll(col1) || playerOne.containsAll(col2) || playerOne.containsAll(col3) ||
            playerOne.containsAll(diag1) || playerOne.containsAll(diag2)) {
            winner = 1
        }

        if (playerTwo.containsAll(row1) || playerTwo.containsAll(row2) || playerTwo.containsAll(row3) ||
            playerTwo.containsAll(col1) || playerTwo.containsAll(col2) || playerTwo.containsAll(col3) ||
            playerTwo.containsAll(diag1) || playerTwo.containsAll(diag2)) {
            winner = 2
        }

        when(winner) {
            1 -> Toast.makeText(this, "Parabéns! Jogador 1 venceu.", Toast.LENGTH_LONG).show()
            2 -> Toast.makeText(this, "Parabéns! Jogador 2 venceu.", Toast.LENGTH_LONG).show()
        }
    }

    fun restart(view: View) {
        playerOne.clear()
        playerTwo.clear()
        setContentView(R.layout.activity_main)
    }
}