package br.com.cybertimeup.appcommerce.model

import androidx.room.Embedded
import androidx.room.Relation

data class UserWithAddresses(
    @Embedded val user: User,
    @Relation(
        parentColumn = "id",
        entityColumn = "userId"
    )
    val addresses: MutableList<UserAddress> = mutableListOf()
)