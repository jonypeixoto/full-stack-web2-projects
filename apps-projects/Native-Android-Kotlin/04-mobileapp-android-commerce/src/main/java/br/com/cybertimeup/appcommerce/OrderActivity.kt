package br.com.cybertimeup.appcommerce

import android.os.Bundle
import android.widget.TextView
import androidx.appcompat.app.AppCompatActivity
import androidx.appcompat.widget.Toolbar

class OrderActivity : AppCompatActivity() {

    lateinit var toolbar: Toolbar
    lateinit var textTitle: TextView

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_cart)

        toolbar = findViewById(R.id.toolbar)
        setSupportActionBar(toolbar)

        supportActionBar?.setDisplayHomeAsUpEnabled(true)
        supportActionBar?.setDisplayShowTitleEnabled(false)

        textTitle = findViewById(R.id.toolbar_title)
        textTitle.text = getString(R.string.order_title)
    }
    override fun onSupportNavigateUp(): Boolean {
        onBackPressed()
        return true
    }
}