package br.com.cybertimeup.appcommerce.repository

import android.app.Application
import br.com.cybertimeup.appcommerce.database.AppDatabase

class OrdersRepository (application: Application) {

    private val orderDao = AppDatabase.getDatabase(application).orderDao()

    fun loadAllByUser(userId: String) = orderDao.loadAllOrdersByUser(userId)

}