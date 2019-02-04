CREATE TABLE IF NOT EXISTS `Pessoas` (
  `PessoaID` int(10) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Senha` varchar(250) NOT NULL,
  `EstadoID` int(11) NOT NULL,
  `Cidade` varchar(150) NOT NULL,
  `Foto` varchar(150) NOT NULL,
  PRIMARY KEY (`PessoaID`)
)
