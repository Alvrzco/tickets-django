# Generated by Django 3.2.2 on 2021-06-12 08:35

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('UAnalytics', '0002_history_dateandtiem'),
    ]

    operations = [
        migrations.RenameField(
            model_name='history',
            old_name='dateandtiem',
            new_name='dateandtime',
        ),
    ]
