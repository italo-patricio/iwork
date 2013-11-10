-------------------------------
-- Cria banco de dados
-------------------------------
DROP DATABASE IF EXISTS `novoalmoxarifado`;
CREATE DATABASE 

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `aquisicao`
-- ----------------------------
DROP TABLE IF EXISTS `aquisicao`;
CREATE TABLE `aquisicao` (
  `idaquisicao` int(11) NOT NULL AUTO_INCREMENT,
  `momento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idaquisicao`),
  KEY `fk_aquisicao_usuario1` (`usuario_idusuario`),
  CONSTRAINT `fk_aquisicao_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aquisicao
-- ----------------------------

-- ----------------------------
-- Table structure for `aquisicao_has_material`
-- ----------------------------
DROP TABLE IF EXISTS `aquisicao_has_material`;
CREATE TABLE `aquisicao_has_material` (
  `aquisicao_idaquisicao` int(11) NOT NULL,
  `material_idmaterial` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`aquisicao_idaquisicao`,`material_idmaterial`),
  KEY `fk_aquisicao_has_material_material1` (`material_idmaterial`),
  KEY `fk_aquisicao_has_material_aquisicao1` (`aquisicao_idaquisicao`),
  CONSTRAINT `fk_aquisicao_has_material_aquisicao1` FOREIGN KEY (`aquisicao_idaquisicao`) REFERENCES `aquisicao` (`idaquisicao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_aquisicao_has_material_material1` FOREIGN KEY (`material_idmaterial`) REFERENCES `material` (`idmaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aquisicao_has_material
-- ----------------------------

-- ----------------------------
-- Table structure for `categoria`
-- ----------------------------
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`idcategoria`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categoria
-- ----------------------------

-- ----------------------------
-- Table structure for `material`
-- ----------------------------
DROP TABLE IF EXISTS `material`;
CREATE TABLE `material` (
  `idmaterial` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `detalhes` text,
  `quantidadeatual` int(11) NOT NULL,
  `categoria_idcategoria` int(11) NOT NULL,
  PRIMARY KEY (`idmaterial`),
  KEY `fk_material_categoria1` (`categoria_idcategoria`),
  CONSTRAINT `fk_material_categoria1` FOREIGN KEY (`categoria_idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of material
-- ----------------------------

-- ----------------------------
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) NOT NULL,
  `link` varchar(40) NOT NULL,
  PRIMARY KEY (`idmenu`),
  UNIQUE KEY `nome_UNIQUE` (`nome`),
  UNIQUE KEY `link_UNIQUE` (`link`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'Entrar', 'index');
INSERT INTO `menu` VALUES ('2', 'Quem somos', 'quemsomos');
INSERT INTO `menu` VALUES ('3', 'Fale conosco', 'faleconosco');
INSERT INTO `menu` VALUES ('4', 'Cliente', 'cliente');
INSERT INTO `menu` VALUES ('5', 'Minha área', 'minhaarea');
INSERT INTO `menu` VALUES ('6', 'Sair', 'logoff');

-- ----------------------------
-- Table structure for `permissao`
-- ----------------------------
DROP TABLE IF EXISTS `permissao`;
CREATE TABLE `permissao` (
  `menu_idmenu` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  PRIMARY KEY (`menu_idmenu`,`usuario_idusuario`),
  KEY `fk_aba_has_usuario_usuario1` (`usuario_idusuario`),
  KEY `fk_aba_has_usuario_aba1` (`menu_idmenu`),
  CONSTRAINT `fk_aba_has_usuario_aba1` FOREIGN KEY (`menu_idmenu`) REFERENCES `menu` (`idmenu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_aba_has_usuario_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of permissao
-- ----------------------------

-- ----------------------------
-- Table structure for `requisicao`
-- ----------------------------
DROP TABLE IF EXISTS `requisicao`;
CREATE TABLE `requisicao` (
  `idrequisicao` int(11) NOT NULL AUTO_INCREMENT,
  `momento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_idusuario` int(11) NOT NULL,
  `status_idstatus` int(11) NOT NULL,
  PRIMARY KEY (`idrequisicao`),
  KEY `fk_requisicao_usuario1` (`usuario_idusuario`),
  KEY `fk_requisicao_status1` (`status_idstatus`),
  CONSTRAINT `fk_requisicao_status1` FOREIGN KEY (`status_idstatus`) REFERENCES `status` (`idstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_requisicao_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of requisicao
-- ----------------------------

-- ----------------------------
-- Table structure for `requisicao_has_material`
-- ----------------------------
DROP TABLE IF EXISTS `requisicao_has_material`;
CREATE TABLE `requisicao_has_material` (
  `requisicao_idrequisicao` int(11) NOT NULL,
  `material_idmaterial` int(11) NOT NULL,
  `qtdrequisitada` int(11) NOT NULL,
  `qtdentregue` int(11) NOT NULL DEFAULT '0',
  `status_idstatus` int(11) NOT NULL,
  PRIMARY KEY (`requisicao_idrequisicao`,`material_idmaterial`),
  KEY `fk_requisicao_has_material_material1` (`material_idmaterial`),
  KEY `fk_requisicao_has_material_requisicao1` (`requisicao_idrequisicao`),
  KEY `fk_requisicao_has_material_status1` (`status_idstatus`),
  CONSTRAINT `fk_requisicao_has_material_material1` FOREIGN KEY (`material_idmaterial`) REFERENCES `material` (`idmaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_requisicao_has_material_requisicao1` FOREIGN KEY (`requisicao_idrequisicao`) REFERENCES `requisicao` (`idrequisicao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_requisicao_has_material_status1` FOREIGN KEY (`status_idstatus`) REFERENCES `status` (`idstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of requisicao_has_material
-- ----------------------------

-- ----------------------------
-- Table structure for `setor`
-- ----------------------------
DROP TABLE IF EXISTS `setor`;
CREATE TABLE `setor` (
  `idsetor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  PRIMARY KEY (`idsetor`),
  UNIQUE KEY `nome_UNIQUE` (`nome`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of setor
-- ----------------------------

-- ----------------------------
-- Table structure for `status`
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `idstatus` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`idstatus`),
  UNIQUE KEY `status_UNIQUE` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of status
-- ----------------------------

-- ----------------------------
-- Table structure for `tipousuario`
-- ----------------------------
DROP TABLE IF EXISTS `tipousuario`;
CREATE TABLE `tipousuario` (
  `idtipousuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`idtipousuario`),
  UNIQUE KEY `tipo_UNIQUE` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipousuario
-- ----------------------------

-- ----------------------------
-- Table structure for `usuario`
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `login` varchar(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `matricula` varchar(45) DEFAULT NULL,
  `senha` varchar(20) NOT NULL,
  `setor_idsetor` int(11) NOT NULL,
  `tipousuario_idtipousuario` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  UNIQUE KEY `matricula_UNIQUE` (`matricula`),
  KEY `fk_usuario_setor` (`setor_idsetor`),
  KEY `fk_usuario_tipousuario1` (`tipousuario_idtipousuario`),
  CONSTRAINT `fk_usuario_setor` FOREIGN KEY (`setor_idsetor`) REFERENCES `setor` (`idsetor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_tipousuario1` FOREIGN KEY (`tipousuario_idtipousuario`) REFERENCES `tipousuario` (`idtipousuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuario
-- ----------------------------
