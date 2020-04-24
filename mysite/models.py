from django.db import models

class Cliente(models.Model):
    Rut_cli = models.CharField(max_length=9, primary_key=True)
    Dv = models.CharField(max_length=1)
    Nombre = models.CharField(max_length=20)
    Apellido = models.CharField(max_length=25)
    Usuario = models.CharField(max_length=25)
    Contraseña = models.CharField(max_length=25)
    Direccion = models.CharField(max_length=25)
    Telefono = models.IntegerField()
    class Meta:
         db_table = "CLIENTE"
