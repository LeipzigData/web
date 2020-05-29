# This file extracts data from a git clone of the source
# https://github.com/CSSEGISandData/COVID-19

my $srcdir="/home/graebe/git/Software/COVID-19";
my $subdir="csse_covid_19_data/csse_covid_19_time_series";
my $dfile="time_series_covid19_deaths_global.csv";
my $cfile="time_series_covid19_confirmed_global.csv";
my $rfile="time_series_covid19_recovered_global.csv";

undef $/;
open(FH,"$srcdir/$subdir/$dfile");
my @ddata=split(/\n/,<FH>);
close FH;
open(FH,"$srcdir/$subdir/$cfile");
my @cdata=split(/\n/,<FH>);
close FH;
open(FH,"$srcdir/$subdir/$rfile");
my @rdata=split(/\n/,<FH>);
close FH;

saveData();

## end main

sub extractData { # infected means positively tested
  my ($land,$token)=@_;
  my (@l,@in,@out);
  @in=grep(/$token/i,@ddata);
  @l=split(/,/,$in[0],5);
  push(@out,$land."[dead]:[".$l[4]."];");
  @in=grep(/$token/i,@cdata);
  @l=split(/,/,$in[0],5);
  push(@out,$land."[infected]:[".$l[4]."];");
  @in=grep(/$token/i,@rdata);
  @l=split(/,/,$in[0],5);
  push(@out,$land."[recovered]:[".$l[4]."];");
  return "/* ====== Data for $land ======= */\n".
    join("\n",@out)."\n\n\n";
}

sub saveData {
  $_.= extractData("Germany","Germany");
  $_.=extractData("Germany","Germany");
  $_.=extractData("Italy","Italy");
  $_.=extractData("Spain","Spain");
  $_.=extractData("Austria","Austria");
  $_.=extractData("China","Hubei,China");
  $_.=extractData("UK","United Kingdom,55");
  $_.=extractData("France","France,46");
  $_.=extractData("Sweden","Sweden");
  open(FH,">BasicData-Maxima.txt");
  print FH $_;
  close FH;
  s/:\[/=\{/gs;
  s/\];/\};/gs;
  open(FH,">BasicData-Mathematica.txt");
  print FH $_;
  close FH;
}


