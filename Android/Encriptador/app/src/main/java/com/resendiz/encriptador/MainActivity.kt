package com.resendiz.encriptador

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.text.Editable
import android.util.Base64
import android.util.Log
import androidx.recyclerview.widget.LinearLayoutManager
import com.resendiz.encriptador.databinding.ActivityMainBinding
import java.lang.RuntimeException
import java.nio.charset.StandardCharsets
import java.util.Base64.getDecoder
import java.util.Base64.getEncoder
import javax.crypto.Cipher
import javax.crypto.KeyGenerator
import javax.crypto.SecretKey
import javax.crypto.SecretKeyFactory
import javax.crypto.spec.IvParameterSpec
import javax.crypto.spec.PBEKeySpec
import javax.crypto.spec.SecretKeySpec

class MainActivity : AppCompatActivity() {
    private val mensajeAEncriptar: String="mensaje a encriptar"
    private val AES: String="AES"
    override fun onCreate(savedInstanceState: Bundle?)
    {
        super.onCreate(savedInstanceState)
        val binding= ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)
        //genero los eventos
        binding.Bencriptar.setOnClickListener(
            {
                try {
                    val texto =binding.TEncriptar.text
                    val s=encrypt("0123456789abcdef", "mT34SaFD5678QAZX", texto.toString())
                    binding.TEncriptado.setText(s.toString())
                    Log.d("TAG", s.toString())
                }
                catch (e: Exception)
                {
                    Log.e("ERROR",e.message.toString())

                }
            }
        )
        binding.BDesencriptar.setOnClickListener(
            {
                try {
                    val texto =binding.TEncriptado.text
                    val s=decrypt("0123456789abcdef",texto.toString())
                    binding.TEncriptar.setText(s.toString())
                    Log.d("TAG", s.toString())
                }
                catch (e: Exception)
                {
                    Log.e("ERROR",e.message.toString())

                }

            }
        )
    }
    private val CIPHER_NAME ="AES/CBC/PKCS7Padding" 
    private val CIPHER_KEY_LEN = 16 //128 bits
    private fun fixKey(key: String): String? {
        var key = key
        if (key.length < CIPHER_KEY_LEN) {
            val numPad = CIPHER_KEY_LEN - key.length
            for (i in 0 until numPad) {
                key += "0" //0 pad to len 16 bytes
            }
            return key
        }
        return if (key.length > CIPHER_KEY_LEN) {
            key.substring(0, CIPHER_KEY_LEN) //truncate to 16 bytes
        } else key
    }
    fun encrypt(key: String?, iv: String, data: String): String? {
        return try {
            val ivSpec = IvParameterSpec(iv.toByteArray(StandardCharsets.UTF_8))
            val secretKey = SecretKeySpec(fixKey(key!!)?.toByteArray(StandardCharsets.UTF_8), "AES")
            val cipher = Cipher.getInstance(CIPHER_NAME)
            cipher.init(Cipher.ENCRYPT_MODE, secretKey, ivSpec)
            val encryptedData = cipher.doFinal(data.toByteArray())
            val encryptedDataInBase64: String = Base64.encodeToString(encryptedData, Base64.DEFAULT)
            val ivInBase64: String =  Base64.encodeToString(iv.toByteArray(StandardCharsets.UTF_8), Base64.DEFAULT)
            "$encryptedDataInBase64:$ivInBase64"
        } catch (ex: java.lang.Exception) {
            throw RuntimeException(ex)
        }
    }
    fun decrypt(key: String, data: String): String? {
        return try {
            val parts = data.split(":").toTypedArray()
            val iv = IvParameterSpec(Base64.decode(parts[1], Base64.DEFAULT))
            val secretKey2 = SecretKeySpec(key.toByteArray(StandardCharsets.UTF_8), "AES")
            val cipher = Cipher.getInstance(CIPHER_NAME)
            cipher.init(Cipher.DECRYPT_MODE, secretKey2, iv)
            val decodedEncryptedData: ByteArray = Base64.decode(parts[0], Base64.DEFAULT)
            val original = cipher.doFinal(decodedEncryptedData)
            String(original)
        } catch (ex: java.lang.Exception) {
            throw RuntimeException(ex)
        }
    }
}