USE user_system_repo;

INSERT INTO roles (role_name) VALUES ('Admin'), ('User');
INSERT INTO users (name, email) VALUES ('Carlos Pérez', 'carlos@example.com');
INSERT INTO profiles (user_id, bio) VALUES (1, 'Administrador principal');
INSERT INTO user_roles (user_id, role_id) VALUES (1, 1);
INSERT INTO projects (project_name) VALUES ('Sistema de Sanitización');
INSERT INTO user_projects (user_id, project_id) VALUES (1, 1);
