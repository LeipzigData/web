##################################
#
# author: graebe
# lastModified: 2020-07-05

# Changes:

# 2018-08-10 - Spielplaetze.ttl ergänzt
# 2018-08-05 - NL-Activities.ttl und NL-Akteure.ttl ergänzt
# 2018-07-03 - Kitas.ttl und Horte.ttl ergänzt
# 2018-05-06 - Zukunftspass entfernt
# 2018-04-13 - MINT-Katalog und Zukunftsdiplom ergänzt
# 2018-03-21 - DCAT ergänzt
# 2018-02-14 - Referenzen aufgelöst und lokal zugeordnet

# purpose: load data into the local Virtuoso store
# usage: perl loaddata.pl | isql-vt 1111 dba <YourSecretPassword>

my $RDFData="/local/home/graebe/lokaleGitRepos/RDFData";
#my $RDFData="/home/graebe/git/LD/RDFData";
# print cleardata();
print loaddata();

## end main ## 

sub cleardata { # nicht aktuell
  return <<EOT;
sparql clear graph <http://leipzig-data.de/Data/AdministrativeGliederung/> ;
sparql clear graph <http://leipzig-data.de/Data/Adressen/> ;
sparql clear graph <http://leipzig-data.de/Data/Buergervereine/> ;
sparql clear graph <http://leipzig-data.de/Data/Events/> ;
sparql clear graph <http://leipzig-data.de/Data/GeoDaten/> ;
sparql clear graph <http://leipzig-data.de/Data/Haltestellen/> ;
sparql clear graph <http://leipzig-data.de/Data/Horte/> ;
# sparql clear graph <http://leipzig-data.de/Data/Jugendstadtplan/> ;
sparql clear graph <http://leipzig-data.de/Data/Kitas/> ;
sparql clear graph <http://leipzig-data.de/Data/KirchlicheEinrichtungen/> ;
sparql clear graph <http://leipzig-data.de/Data/MINTBroschuere2014/> ;
sparql clear graph <http://leipzig-data.de/Data/OeffentlicheEinrichtungen/> ;
sparql clear graph <http://leipzig-data.de/Data/Orte/> ;
sparql clear graph <http://leipzig-data.de/Data/Personen/> ;
sparql clear graph <http://leipzig-data.de/Data/PolizeidirektionLeipzig/> ;
sparql clear graph <http://leipzig-data.de/Data/Projekte/> ;
sparql clear graph <http://leipzig-data.de/Data/Schulen/> ;
sparql clear graph <http://leipzig-data.de/Data/Seniorenbueros/> ;
sparql clear graph <http://leipzig-data.de/Data/Spielplaetze/> ;
sparql clear graph <http://leipzig-data.de/Data/Stadtverwaltung/> ;
sparql clear graph <http://leipzig-data.de/Data/Strassenverzeichnis/> ;
sparql clear graph <http://leipzig-data.de/Data/Tags/> ;
sparql clear graph <http://leipzig-data.de/Data/Treffpunkte/> ;
sparql clear graph <http://leipzig-data.de/Data/Unternehmen/> ;
sparql clear graph <http://leipzig-data.de/Data/Vereine/> ;
sparql clear graph <http://leipzig-data.de/Data/WeitereAdressen/> ;
sparql clear graph <http://leipzig-data.de/Data/Zukunftsdiplom/> ;
EOT
}

sub loaddata {
  my $out;
  $out.=createLoadCommand("http://leipzig-data.de/Data/","LeipzigData.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/AdministrativeGliederung/","AdministrativeGliederung.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Adressen/","Adressen.ttl");
  # $out.=createLoadCommand("http://leipzig-data.de/Data/AlteEvents/","AlteEvents.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Buergervereine/","Buergervereine.ttl");
  # $out.=createLoadCommand("http://leipzig-data.de/Data/Events/","Events.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/GeoDaten/","GeoDaten.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Haltestellen/","Haltestellen.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Hochschulen/","Hochschulen.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Horte/","Horte.ttl");
  #$out.=createLoadCommand("http://leipzig-data.de/Data/Jugendstadtplan/","Jugendstadtplan.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/KirchlicheEinrichtungen/","KirchlicheEinrichtungen.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Kitas/","Kitas.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/MINTBroschuere2014/","MINTBroschuere2014.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/MINT-Katalog/","MINT-Katalog.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/OeffentlicheEinrichtungen/","OeffentlicheEinrichtungen.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Orte/","Orte.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Personen/","Personen.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/PolizeidirektionLeipzig/","PolizeidirektionLeipzig.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Projekte/","Projekte.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Schulen/","Schulen.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Seniorenbueros/","Seniorenbueros.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Spielplaetze/","Spielplaetze.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Stadtverwaltung/","Stadtverwaltung.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Strassenverzeichnis/","Strassenverzeichnis.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Tags/","Tags.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Treffpunkte/","Treffpunkte.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Unternehmen/","Unternehmen.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/Vereine/","Vereine.ttl");
  $out.=createLoadCommand("http://leipzig-data.de/Data/WeitereAdressen/","WeitereAdressen.ttl");
  $out.=createLoadCommand("http://nachhaltiges-leipzig.de/Data/MINT-Preistraeger-2019/","MINT-Preistraeger-2019.ttl");
  $out.=createLoadCommand("http://nachhaltiges-leipzig.de/Data/MINT-Preistraeger-2020/","MINT-Preistraeger-2020.ttl");
  return $out;
}

sub createLoadCommand {
  my ($graph,$file)=@_;
  return<<EOT;
sparql clear graph <$graph> ;
sparql create silent graph <$graph> ; 
DB.DBA.TTLP_MT (file_to_string_output('$RDFData/$file'),'$graph'); 
EOT
}


__END__

