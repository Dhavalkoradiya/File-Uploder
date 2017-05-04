-----------------------------------------------------------
-- DATABASE TABLE STRUCTURE


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `filedata`
--

CREATE TABLE `filedata` (
  `id` int(11) NOT NULL,
  `realname` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filedata`
--

INSERT INTO `filedata` (`id`, `realname`, `type`, `modified`) VALUES
(1, 'image1.jpg', 'image/jpeg', '2017-05-04 08:52:30'),
(2, 'zipfile.zip', 'application/octet-stream', '2017-05-04 08:56:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `filedata`
--
ALTER TABLE `filedata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `filedata`
--
ALTER TABLE `filedata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;