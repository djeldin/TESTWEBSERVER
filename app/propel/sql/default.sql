# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- WS
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `WS`;

CREATE TABLE `WS`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `telefono` VARCHAR(100),
    `status` VARCHAR(100),
    `marca` VARCHAR(100),
    `modelo` VARCHAR(100),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
