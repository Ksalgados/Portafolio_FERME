from django.urls import path

from . import views

urlpatterns = [
    path('',views.index,name='index'),
    path('set_herramientas/',views.set_herramientas,name='set_herramientas'),
    path('registrar/',views.registrar,name='Registrar'),
]
