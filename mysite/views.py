from django.shortcuts import render
from .models import Cliente

def index(request):
        return render(
                request,
                'index.html',
        )

def registrar(request):
        return render(
                request,
                'Registrar.html',
        )

def set_herramientas(request):
        return render(
                request,
                'set_herramientas.html',
        )
