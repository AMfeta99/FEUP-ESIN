# Hospital Management System
Authors: Ana Filipa Ferreira & Ana Maria Sousa

Na página inicial do website [index.php](./index.php), pode ser consultada alguma informação acerca do hospital, assim como, através desta pode ser feito o login e o rastreamento de um paciente internado, através da inserção de um código. 
O formulário do registo tambem pode ser acedido atravez do index.php. O registo é diferente dependendo do papel a desempenhar no hospital (patient, doctor, nurse). O login é feito através do mail que é inserido no registo.
Para além disso é possvel aceder a informações dos departamentos como medicos do departamento em department.php acedido através d "Department&Doctors" do index.php. 
Após selecionar o departamente terá acesso aos medicos do departamento e poderá consultar as informações de cada medico. 

### Papel do médico
- Se fizer login e for um doctor, é reencaminhado para o file [Doctor.php](./Doctor.php), nesta página poderá criar o seu horário, consultar os seus pacientes internados e dar alta ou hospitalizar um novo paciente. Esse paciente será automaticamente inserido numa cama pertencente ao mesmo departamento do médico que o adicionou, e será monitorizado tanto pelo médico que o adicionou como pelos enfermeiros pertencentes ao mesmo departamento.
- Quanto à parte das consultas externas, o médico poderá consultar as consultas que irá realizar e adicionar informação a estas, como por exemplo prescrever um medicamento. O médico recebe também um pedido de reserva de consulta, sendo este quem gere se quer aceitar ou rejeitar o pedido . 

### Papel do paciente
- Se for um paciente a fazer login ([index_f_login.php](./index_f_login.php)), ele poderá consultar as suas consultas agendadas, as receitas médicas, o perfil de paciente internado (caso esteja hospitalizado) e também poderá marcar consultas, recebendo depois um notificação se o pedido de reserva foi aceite ou não pelo médico.

### Papel do enfermeiro
- O enfermeiro, ([nurse.php](./nurse.php)) poderá consultar os pacientes internados no seu departamento e também adicionar informações relativas a estes.
