# Generated by Django 3.0.5 on 2020-04-23 22:29

from django.db import migrations, models


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Cliente',
            fields=[
                ('Rut_cli', models.CharField(max_length=9, primary_key=True, serialize=False)),
                ('Dv', models.CharField(max_length=1)),
                ('Nombre', models.CharField(max_length=20)),
                ('Apellido', models.CharField(max_length=25)),
                ('Usuario', models.CharField(max_length=25)),
                ('Contraseña', models.CharField(max_length=25)),
                ('Direccion', models.CharField(max_length=25)),
                ('Telefono', models.IntegerField()),
            ],
            options={
                'db_table': 'CLIENTE',
            },
        ),
    ]