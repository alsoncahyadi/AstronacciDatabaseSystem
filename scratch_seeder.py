experiment = 4

if experiment == 1:
	import os

	commands = []
	# commands.append("echo HAI!")
	# commands.append("php artisan db:seed --class=UobTableSeeder")
	# commands.append("php artisan db:seed --class=CatTableSeeder")

	for i in range(0,900):
		commands.append("php artisan db:seed --class=AclubTransactionTableSeeder")

	for index, command in enumerate(commands):
		print("[COMMAND {}]: {}".format(index, command))
		os.system(command)
	exit()
elif experiment == 2:
	import random
	import faker

	fake = faker.Faker()

	table_name = 'cats'
	first_master_id = 1003720 + 11000
	master_id = first_master_id
	user_id = 100 + 11000
	command = ''
	command += "INSERT INTO {}".format(table_name) + '\n'
	command += " VALUE " + '\n'
	number_of_row = 10000

	fh = open("cat_query.txt","w")

	for i in range(0,number_of_row):
		user_id += 1
		master_id += 1
		batch = random.randint(0,10)
		nomor_induk = user_id
		sales_name = fake.name()
		sumber_data = fake.name()[:20]
		DP_date = fake.date()
		DP_nominal = random.randint(2,9)*1000000
		payment_date = fake.date()
		payment_nominal = random.randint(2,9)*1000000
		tanggal_opening_class = fake.date()
		tanggal_end_class = fake.date()
		tanggal_ujian = fake.date()
		status = 'status ' + str(nomor_induk)
		keterangan = 'keterangan ' + str(nomor_induk)

		value = "('{}', '{}', '{}', {}, '{}', '{}', '{}', {}, '{}', '{}', '{}', '{}', '{}', '{}', '{}', NOW(), NOW(), 999, 999)"
		value = value.format(user_id, nomor_induk, master_id, batch, sales_name, sumber_data, DP_date, DP_nominal, payment_date, payment_nominal, tanggal_opening_class, 
			tanggal_end_class, tanggal_ujian, status, keterangan)
		if i == number_of_row-1:
			command += value
		else:
			command += value + ', \n'

	fh.write(command)
	fh.close()
elif experiment == 3:
	import random
	import faker

	fake = faker.Faker()

	table_name = 'aclub_informations'
	first_master_id = 1003721-1
	master_id = first_master_id

	command = ''
	command += "INSERT INTO {}".format(table_name) + '\n'
	command += " VALUE " + '\n'

	number_of_row = 9000

	fh = open("aclub_information_query.txt","w")

	created_by = 999
	updated_by = created_by

	for i in range(0,number_of_row):
		master_id += 1
		sumber_data = fake.name()
		keterangan = fake.name()
		updated_at = fake.date()
		created_at = updated_at

		value = "('{}', '{}', '{}', '{}', '{}', {}, {})"
		value = value.format(master_id, sumber_data, keterangan, created_at, updated_at, created_by, updated_by)

		if i == number_of_row-1:
			command += value
		else:
			command += value + ', \n'

	fh.write(command)
	fh.close()
elif experiment == 3:

	import random
	import faker

	fake = faker.Faker()

	table_name = 'aclub_transactions'

	# master_id = first_master_id

	command = ''
	command += "INSERT INTO {}".format(table_name) + '\n'
	command += " VALUE " + '\n'
	user_id = 4100
	transaction_id = 15000
	number_of_row = 15000

	fh = open("aclub_transaction_query.txt","w")

	created_by = 999
	updated_by = created_by

	for i in range(0,number_of_row):
		transaction_id += 1
		user_id += 1
		payment_date = fake.date()
		kode = random.choice(['XS','XG', 'XP'])
		status = 'Perpanjang'
		nominal = random.randint(2,9)*1000000
		start_date = fake.date()
		expired_date = start_date
		masa_tenggang = start_date
		yellow_zone = start_date
		red_zone = start_date
		created_at = fake.date()
		updated_at = created_at
		sales_name = fake.name().replace("'", '').replace('"','')

		value = "({}, '{}', '{}', '{}', '{}', {}, '{}', '{}', '{}', '{}', '{}', '{}', '{}', '{}', {}, {})"
		value = value.format(	transaction_id,
								user_id,
								payment_date,
								kode,
								status,
								nominal,
								start_date,
								expired_date,
								masa_tenggang,
								yellow_zone,
								red_zone,
								created_at,
								updated_at,
								sales_name,
								created_by,
								updated_by)

		if i == number_of_row-1:
			command += value
		else:
			command += value + ', \n'

	fh.write(command)
	fh.close()



import random
import faker

fake = faker.Faker()

table_name = 'mrg_accounts'

# master_id = first_master_id

command = ''
command += "INSERT INTO {}".format(table_name) + '\n'
command += " VALUE " + '\n'

first_master_id = 1003730
master_id = first_master_id

fh = open("mrg_accounts_query.txt",'w')

created_by = 999
updated_by = created_by
accounts_number = 8100

number_of_row = 4000

for i in range(0,number_of_row):
	accounts_number += 1
	master_id += 1
	account_type = random.choice(['Recreation','Basic','Syariah','Signature'])
	sales_name = fake.name()
	created_at = fake.date()
	updated_at = created_at

	value = "('{}', {}, '{}','{}','{}','{}',{},{})"
	value = value.format(	accounts_number,
							master_id,
							account_type,
							sales_name,
							created_at,
							updated_at,
							created_by,
							updated_by)

	if i == number_of_row-1:
		command += value
	else:
		command += value + ', \n'

fh.write(command)
fh.close()