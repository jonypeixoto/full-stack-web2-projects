package br.com.arquitetoandroid.appcommerce.repository

import android.app.Application
import br.com.cybertimeup.appcommerce.database.AppDatabase
import br.com.cybertimeup.appcommerce.model.Product
import br.com.cybertimeup.appcommerce.model.ProductVariants

class ProductsRepository (application: Application) {

    private val productDao = AppDatabase.getDatabase(application).productDao()

    private val productCategoryDao = AppDatabase.getDatabase(application).productCategoryDao()

    val allCategories = productCategoryDao.loadAll()

    val featuredCategories = productCategoryDao.loadAllFeatured()

    val featuredProducts = productDao.loadAllFeatured()

    fun loadProductsByCategory(categoryId: String) = productDao.loadAllByCategory(categoryId)

    fun loadProductById(productId: String) = productDao.loadProductWithVariants(productId)
}